<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use OpenCF\RecommenderService;
use Laudis\Neo4j\Basic\Session as BasicSession;
use PDF;

class StatisticsController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index($id) 
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($id);
        $queryStatistics = $this->session->run(<<<'CYPHER'
        MATCH(u:User{id: $myID}) - [:`Đăng bán`] -> (p:Product) - [rel:`Phiên giao dịch`] -> (s:Session) <- [:`Đặt mua`] - (o:Order)
        WHERE o.status = "Hoàn Thành"
        RETURN u.Username as username, p.name as product_name, rel.quantity as quantity, rel.price as price, s.Session_endtime as session_endtime, p.id as idProduct, sum(o.totalPrice) as totalPrice
        CYPHER,
        [
            'myID' => $myID
        ]);

        $getStatistics =[];
        foreach($queryStatistics as $item) 
        {
            array_push($getStatistics, $item);
        }
        return view ('statistics', ['id' => $user['id'], 'getStatistics' => $getStatistics, 'user' => $user]);
    }

    public  function printStatistics (Request $request)
    {   
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = intval($user->id);
        $month = $request->input('month');
        $months = str_pad($month, strlen($month) + 2, "-", STR_PAD_BOTH);
        //$month = 05;
        //var_dump($month);
        $queryPrintStatistics = $this->session->run(<<<'CYPHER'
        MATCH (u:User {id: $myID}) -[:`Đăng bán`]-> (p:Product) -[rel:`Phiên giao dịch`]-> (s:Session) <-[:`Đặt mua`]- (o:Order)
        WHERE toString(s.Session_endtime) CONTAINS $month
        RETURN sum(o.totalPrice) as totalPrice, s.Session_endtime as session_endtime, p.name as product_name, rel.quantity as quantity, rel.price as price, u.Username as username
        CYPHER,
        [
            'myID' => $myID,
            "month" => $months
        ]);

        $printStatistics = [];
        $totalRevenue = 0;
        foreach($queryPrintStatistics as $value)
        {
            array_push($printStatistics, $value);
            $totalRevenue += $value['totalPrice'];

        }

        $data = [
            'printStatistics' => $printStatistics,
            'totalRevenue' => $totalRevenue,
            'month' => $month,
            'username' => $value['username']
        ];
        //return response($value['username']);
        $pdf = PDF::loadView('statistics-PDF', $data);
        return $pdf->stream('statistics-PDF.pdf');
    }
}
