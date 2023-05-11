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
}
