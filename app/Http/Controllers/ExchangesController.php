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

class ExchangesController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index ()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        //MATCH(u:User) - [:`Đăng bán`] -> (p:Product) - [:`Thuộc loại`] -> (c:Category), (p:Product) - [:`thuộc phiên giao dịch`] -> (s:Session)
        //RETURN p.name as product_name, p.desc as desc, p.img as img, p.price as price, p.quantity as quantity, c.category_name as category_name, s.Session_endtime as Session_endtime
        $getAllProducts = $this->session->run(<<<'CYPHER'
        MATCH (u:User) - [:`Đăng bán`] -> (p:Product) - [:`Thuộc loại`] -> (c:Category), (p:Product) - [rel:`Phiên giao dịch`] -> (s:Session)
        RETURN u.id as id, u.Username as username,  p.name as product_name, p.desc as desc, p.img as img, rel.price as price, rel.quantity as quantity, c.category_name as category_name, s.Session_endtime as Session_endtime, p.id as idProduct
        CYPHER,
        [
        ]);

        $new_all_product = array();
        foreach($getAllProducts as $getAllProduct){
            array_push($new_all_product, $getAllProduct);
        }
        //return response($new_all_product);
        return view('exchanges', ['user' => $user, 'getAllProducts' => $new_all_product]);
    }
}
