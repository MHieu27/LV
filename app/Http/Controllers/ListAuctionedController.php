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
        RETURN s.Session_endtime as id_session, u.Username as username, p.name as product_name, o.order_price as order_price, o.order_quantity as order_quantity ,u2.Username as seller, p.id as idProduct, u2.id as idSeller, o.status as order_status
        CYPHER,
        [
            'id' => $id
        ]);
        
        $getAllListAuctioned =[];
        $getAllListAuctioned1 =[];
        foreach($queryListAuctioned as $item) 
        {
            
            $result2 = $this->session->run(<<<'CYPHER'
            MATCH (u:User{id: $id})-[r:REVIEWED]->(s:Session{Session_endtime: $id_s})
            RETURN u,r.rating as rating,s
            CYPHER,['id' => $id,'id_s' => $item['id_session']]);
            if(count($result2) == 0){
                $getAllListAuctioned1[] = $item['id_session'];
            }else{
                foreach($result2 as $item1){
                    if($item1['rating'] === " "){
                        $getAllListAuctioned1[] = $item['id_session'];
                    }
                }
            }
            array_push($getAllListAuctioned, $item);
            
            
        }
     /*    dd($getAllListAuctioned1);  */ 
        $result = $this->session->run(<<<'CYPHER'
            MATCH p=()-[r:`đánh giá người bán`]->() RETURN p
        CYPHER);
        $array_criteria = array();
        foreach($result as $value){
            $title = $value['p']['nodes']['1']['properties']['title'];
            $percent = $value['p']['nodes']['1']['properties']['percent'];
            $array_criteria[$title] = $percent;
        }   
        return view ('list-auctioned', ['getAllListAuctioned1'=>$getAllListAuctioned1,'criteria'=>$array_criteria,'id' => $user['id'], 'getAllListAuctioned' => $getAllListAuctioned, 'user' => $user]);
    }
    public function evalution(Request $request){
        $avg = 0;
        $id = intval(Auth::id());
        $id_s = $request['print-idprd'];
        foreach($request->all() as $item => $value){
            if($item ==='print-idprd' || $item === '_token')continue;
            $avg += $value;
        }
        $result = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $id})-[r:REVIEWED]->(s:Session{Session_endtime: $id_s})
        RETURN r
        CYPHER,['id' => $id,'id_s' => $id_s]);
        if(count($result) != 0){
            $result1 = $this->session->run(<<<'CYPHER'
            MATCH (u:User{id: $id})-[r:REVIEWED]->(s:Session{Session_endtime: $id_s})
            SET r.rating = $rating
            RETURN r
            CYPHER,['id' => $id,'id_s' => $id_s,'rating' => $avg]);            
            return response()->json($result1);
        }
            $result1 = $this->session->run(<<<'CYPHER'
            MATCH (u:User{id: $id}),(prd:Session)
            WHERE NOT (u)-[:REVIEWED]->(prd)
            create (u)-[r:REVIEWED{rating: ' '}]->(prd)
            return r
            CYPHER,['id' => $id]);
            $result2 = $this->session->run(<<<'CYPHER'
            MATCH (u:User{id: $id})-[r:REVIEWED]->(s:Session{Session_endtime: $id_s})
            SET r.rating = $rating
            RETURN r
            CYPHER,['id' => $id,'id_s' => $id_s,'rating' => $avg]);                    
            return response()->json($result2);
    }
}
