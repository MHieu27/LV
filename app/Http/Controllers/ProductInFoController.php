<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use OpenCF\RecommenderService;
use Laudis\Neo4j\Basic\Session as BasicSession;
use stdClass;

class ProductInFoController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index ($id)
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $id = intval($id);

        $getProductInfos = $this->session->run(<<<'CYPHER'
        MATCH (u:User) - [:`Đăng bán`] -> (p:Product{id: $id}) - [:`Thuộc loại`] -> (c:Category), (p:Product) - [rel:`Phiên giao dịch`] -> (s:Session)
        RETURN u.id as id, u.Username as username,  p.name as product_name, p.desc as desc, p.img as img, rel.price as price, rel.quantity as quantity, c.category_name as category_name, s.Session_endtime as Session_endtime, p.id as idProduct
        CYPHER,
        [
            'id' => $id,
        ]);

        $new_productInfo= array();
        foreach($getProductInfos as $getProductInfo){
            array_push($new_productInfo, $getProductInfo);
        }

        $result = $this->session->run(<<<'CYPHER'
        MATCH(u:User) - [:Mua] -> (o:Order) - [:`Đặt mua`] -> (s:Session) <- [rel:`Phiên giao dịch`] - (p:Product{id: $id}) 
        RETURN  u.id as id, u.Username as username, o.order_price as order_price, o.order_quantity as order_quantity, s.Session_endtime as session_endtime, rel.quantity as quantity, rel.price as price, o.id as orderID, o.status as order_status
        CYPHER,
        [
            'id' => $id,
        ]);

        $getOrderUsers = [];
        foreach($result as $item){
            array_push($getOrderUsers, $item);
        }
        //return response($getOrderUsers);
        return view('product-info',['productInfos' => $new_productInfo, 'getOrderUsers' => $getOrderUsers, 'username' => $user['Username'], 'id' => $user['id'], 'checkSeller' => $getProductInfo['username']]);
    }

    public function orderByUser (Request $request, $id) 
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $order = $request->all();
        $id = intval($id);
        $orders = $this->session->run(<<<'CYPHER'
        MATCH(p:Product{id: $id}) - [:`Phiên giao dịch`] -> (s:Session) 
        MERGE(u:User{email:$email})
        MERGE(o:Order{order_price: $order_price, order_quantity: $order_quantity, status: 'Đã đấu giá'})
        MERGE(u) - [:`Mua`] -> (o) - [:`Đặt mua`] -> (s)
        SET o.id = id(o)
        RETURN u.id as id, u.Username as username, o.order_price as order_price, o.order_quantity as order_quantity, p.name as productname, s.Session_endtime as time

        CYPHER,
        [
            'email' => $user->email,
            'id' => $id,
            'order_price' => $order['order_price'],
            'order_quantity' => $order['order_quantity']
        ]);

        

        return redirect() -> route('product-info',['id' => $id]);
    }

    public function updateByUser (Request $request, $id)
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $update = $request->all();
        $id = intval($id);
        $queryUpdate = $this->session->run(<<<'CYPHER'
        MATCH(u:User{id: $myID}) - [:Mua] -> (o:Order) - [:`Đặt mua`] -> (s:Session) <- [:`Phiên giao dịch`] - (p:Product{id: $idProduct})
        SET o.order_price = $update_price, o.order_quantity = $update_quantity
        RETURN u,o,s,p

        CYPHER,
        [
            'myID' => $user->id,
            'idProduct' => $id,
            'update_price' => $update['update_price'],
            'update_quantity' => $update['update_quantity']
        ]);

        return redirect() -> route('product-info', ['id' => $id]);
    }
}
