<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use DateTime;
use Faker\Provider\Image;
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

        //lấy danh mục
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

        //lấy tất cả sản phẩm
        $getProducts = $this->session->run(<<<'CYPHER'
        MATCH(u:User{email: $email}) - [:`Đăng bán`] -> (p:Product) - [:`Thuộc loại`] -> (c:Category), (p:Product) - [rel:`Phiên giao dịch`] -> (s:Session)
        RETURN p.name as product_name, p.desc as desc, p.img as img, rel.price as price, rel.quantity as quantity, c.category_name as category_name, s.Session_endtime as Session_endtime, p.id as idProduct, s.id as idSession
        CYPHER,
        [
            'email' => $user->email,
        ]);

        $new_product = array();
        foreach($getProducts as $getProduct){
            array_push($new_product, $getProduct);
        }
        //$createdate = date('Y/m/d H:i:s', $test1);
        //return response($new_product);
        return view('exchange-management', ['user' => $user, 'namecategory' => $new_category, 'products' => $new_product]);
    }

    public function createProduct (Request $request) {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $product = $request->all();
        $file = $request->img;
        $file_name = $file->getClientoriginalName();
        $file->move(public_path('uploads'), $file_name);
        //dd($product);
        $result=$this->session->run(<<<'CYPHER'
        MERGE (u:User{email: $email})
        MERGE (p:Product{name: $name,
            desc: $desc,
            img: $img})
        MERGE (c:Category{category_name: $category_name})
        MERGE (s:Session{Session_endtime: $Session_endtime})
        MERGE (u)- [:`Đăng bán`] ->(p) -[:`Thuộc loại`] -> (c)
        MERGE (p) - [rel: `Phiên giao dịch`{price: $price,quantity: $quantity}] -> (s)
        SET s.id = id(s), p.id = id(p)
        RETURN p
        CYPHER,
        [
            'email' => $user->email,
            'name' => $product['product_name'],
            'desc' => $product['desc'],
            'img' => $file_name,
            'category_name' => $product['category_name'],
            'price' => $product['price'],
            'quantity' => $product['quantity'],
            'Session_endtime' => $product['Session_endtime']
        ]);
        return redirect() -> route('exchanges-management');
    }

    public function deleteProduct ($id) {
        $id = intval($id);
        $this->session->run(<<<'CYPHER'
        MATCH(p:Product{id: $id})- [:`Phiên giao dịch`] -> (s:Session)
        DETACH DELETE p
        CYPHER,
        [
            'id' => $id
        ]);
        // MATCH(p:Product{id: $id}) - [:`Phiên giao dịch`] -> (s:Session) <- [:`Đặt mua`] - (o:Order)
        // DETACH DELETE p
        //return view('exchanges-management');
        return redirect() -> route('exchanges-management');
    }

}
