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
use stdClass;

class QLExchangesController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index ()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $getCategory = $this->session->run(<<<'CYPHER'
        MATCH (c:Category) 
        RETURN c
        CYPHER,
        [
        ]);
        $new_category = [];
        foreach($getCategory as $result){
            $getValue = $result['c']['properties'];
            array_push($new_category,$getValue);
        }

        $getProducts = $this->session->run(<<<'CYPHER'
        MATCH(u:User{email: $email}) - [:`Đăng bán`] -> (p:Product) - [:`Thuộc loại`] -> (c:Category) 
        RETURN p.name as product_name, p.desc as desc, p.img as img, p.price as price, p.quantity as quantity, c.category_name as category_name
        CYPHER,
        [
            'email' => $user->email,
        ]);

        $new_product = array();
        foreach($getProducts as $getProduct){
            array_push($new_product, $getProduct);
        }

        //return response($new_category);
        return view('exchange-management', ['user' => $user, 'namecategory' => $new_category, 'products' => $new_product]);
    }

    public function createProduct (Request $request) {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $product = $request->all();
        $this->session->run(<<<'CYPHER'
        MERGE (u:User{email: $email})
        MERGE (p:Product{name: $name,
            desc: $desc,
            img: $img,
            price: $price,
            quantity: $quantity})
        MERGE (c:Category{category_name: $category_name})
        MERGE (u)- [:`Đăng bán`] ->(p) -[:`Thuộc loại`] -> (c)
        RETURN p
        CYPHER,
        [
            'email' => $user->email,
            'name' => $product['product_name'],
            'desc' => $product['desc'],
            'img' => $product['img'],
            'category_name' => $product['category_name'],
            'price' => $product['price'],
            'quantity' => $product['quantity'],
        ]);

        //return response($product);
        return redirect() -> route('exchanges-management');
    }

    public function deleteProduct ($name) {
        $this->session->run(<<<'CYPHER'
        MATCH (p:Product{name: $name})
        DETACH DELETE p
        RETURN p
        CYPHER,
        [
            'name' => $name
        ]);
        //return view('exchanges-management');
        return redirect() -> route('exchanges-management');
    }

}
