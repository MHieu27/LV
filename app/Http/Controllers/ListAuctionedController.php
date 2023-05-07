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


class ListAuctionedController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index($id) 
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $id = intval($id);
        $queryListAuctioned = $this->session->run(<<<'CYPHER'
        MATCH(u:User{id: $id}) - [:Mua] -> (o:Order) - [:`Đặt mua`] -> (s:Session) <- [:`Phiên giao dịch`] - (p:Product) <- [:`Đăng bán`] - (u2)
        RETURN u.Username as username, p.name as product_name, o.order_price as order_price, o.order_quantity as order_quantity ,u2.Username as seller, p.id as idProduct, u2.id as idSeller, o.status as order_status
        CYPHER,
        [
            'id' => $id
        ]);

        $getAllListAuctioned =[];
        foreach($queryListAuctioned as $item) 
        {
            array_push($getAllListAuctioned, $item);
        }
        return view ('list-auctioned', ['id' => $user['id'], 'getAllListAuctioned' => $getAllListAuctioned]);
    }
}
