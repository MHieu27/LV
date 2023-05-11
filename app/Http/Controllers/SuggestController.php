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

class SuggestController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index($id) {
        $id = intval($id);
        $querySuggest = $this->session->run(<<<'CYPHER'
        MATCH(u:User) - [:Mua] -> (o:Order) - [:`Đặt mua`] -> (s:Session) <- [rel:`Phiên giao dịch`] - (p:Product{id: $id}) 
        RETURN  u.id as id, u.Username as username, o.order_price as order_price, o.order_quantity as order_quantity, s.Session_endtime as session_endtime, rel.quantity as quantity, rel.price as price
        CYPHER,
        [
            'id' => $id,
        ]);

        $suggests = [];
        foreach($querySuggest as $item){
            array_push($suggests, $item);
        }
        //return response($suggest);
        return view('suggest', ['suggests' => $suggests]);
    }
}
