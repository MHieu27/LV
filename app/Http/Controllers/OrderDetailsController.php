<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use OpenCF\RecommenderService;
use Laudis\Neo4j\Basic\Session as BasicSession;
use PDF;

class OrderDetailsController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index ($id)
    {
        $id = intval($id);
        $queryGetBuyer = $this->session->run(<<<'CYPHER'
        MATCH(u:User) - [:Mua] -> (o:Order{id: $id}) - [:`Đặt mua`] -> (s:Session) <- [:`Phiên giao dịch`] - (p:Product)
        RETURN u.Username as username, u.address as address, u.phonenumber as phonenumber, p.name as product_name, o.order_price as order_price, o.order_quantity as order_quantity, o.id as idOrder
        CYPHER,
        [
            'id' => $id,
        ]);

        $getBuyers = [];
        foreach($queryGetBuyer as $value)
        {
            array_push($getBuyers, $value);
        }

        //return response($getBuyer);
        return view('order-details', ['getBuyers' => $getBuyers]);
    }

    public function confirmOrder (Request $request, $id)
    {
        $id = intval($id);
        $totalPrice = $request->input('totalPrice');
        $totalPrice = intval($totalPrice);
        $queryconfirmOrder = $this->session->run(<<<'CYPHER'
        MATCH(u:User) - [:Mua] -> (o:Order{id: $id}) - [:`Đặt mua`] -> (s:Session) <- [:`Phiên giao dịch`] - (p:Product)
        SET o.status = 'Hoàn Thành'
        SET o.totalPrice = $totalPrice
        RETURN p.id as idProduct
        CYPHER,
        [
            'id' => $id,
            'totalPrice' => $totalPrice
        ]);

        foreach($queryconfirmOrder as $value)
        {
        }
        
        return redirect()-> route('product-info', ['id' => $value['idProduct']]);
    }

    // public  function printOrder ($id)
    // {
    //     $id = intval($id);
    //     $queryGetBuyer = $this->session->run(<<<'CYPHER'
    //     MATCH(u:User) - [:Mua] -> (o:Order{id: $id}) - [:`Đặt mua`] -> (s:Session) <- [:`Phiên giao dịch`] - (p:Product)
    //     RETURN u.Username as username, u.address as address, u.phonenumber as phonenumber, p.name as product_name, o.order_price as order_price, o.order_quantity as order_quantity, o.id as idOrder
    //     CYPHER,
    //     [
    //         'id' => $id,
    //     ]);

    //     $getBuyers = [];
    //     foreach($queryGetBuyer as $value)
    //     {
    //         array_push($getBuyers, $value);
    //     }
    //     $pdf = PDF::loadView('order-PDF', ['getBuyers' => $getBuyers]);
    //     return $pdf->stream('order-PDF.pdf');
    // }
}
