<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use OpenCF\RecommenderService;
use Laudis\Neo4j\Basic\Session as BasicSession;

class AdminController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }


    public function listUsers ()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $queryListUsers= $this->session->run(<<<'CYPHER'
        MATCH (u:User) 
        Return u.Username as username, u.email as email, u.address as address, u.birthday as birthday, u.phonenumber as phonenumber, u.gender as gender, u.id as id
        CYPHER,
        [
        ]);

        $listUsers = [];
        foreach($queryListUsers as $value)
        {
            array_push($listUsers, $value);
        }
        //return response($user)
        if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com'){
            return view('all-user',['listUsers' => $listUsers, 'id' => $user['id'], 'user' => $user]);
        }else{
        
        return redirect()->route('home');
        }
    }
    public function createcriteria(Request $request){
        
        $result = array();
        foreach ($request->all() as $key => $value) {
            if ($key !== '_token') {
                $result[$request['ten' . substr($key, -1)]] = $request['tyle' . substr($key, -1)];
            }
        }
        foreach($result as $item => $value){
            $queryListSessions= $this->session->run(<<<'CYPHER'
            match(u:User{email:"minhhieu@gmail.com"})
            create(cm1:Criteria{title: $title, percent: $percent})
            create (u)-[:`đánh giá người bán`]->(cm1)            
            CYPHER,['title'=>$item,'percent'=>$value]);
        }
        return redirect()->back();
    }
    public function listSession ()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $queryListSessions= $this->session->run(<<<'CYPHER'
        MATCH (s:Session) <- [rel:`Phiên giao dịch`] - (p:Product) - [:`Đăng bán`] - (u:User)
        RETURN u.Username as username, p.name as product_name, rel.price as price, rel.quantity as quantity, s.Session_endtime as session_endtime, u.id as idSeller, p.id as idProduct
        CYPHER,
        [
        ]);

        $listSessions = [];
        foreach($queryListSessions as $value)
        {
            array_push($listSessions, $value);
        }
        //return response($user)
        if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com'){
            return view('all-session',['listSessions' => $listSessions, 'id' => $user['id'], 'user' => $user]);
        }else{
        
        return redirect()->route('home');
        }
    }
    public function criteria(){
        $user = new UserResource(User::findOrFail(Auth::id()));
        $result= $this->session->run(<<<'CYPHER'
        MATCH p=()-[r:`đánh giá người bán`]->() 
        RETURN p
        CYPHER);
        $array_criteria = [];
        foreach($result as $value)
        { 
            $title = $value['p']['nodes'][1]['properties']['title'];
            $percent = $value['p']['nodes'][1]['properties']['percent'];
            $array_criteria[] = ['title'=>$title,'percent'=>$percent];
        }
        //return response($user)
        if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com'){
            return view('criteria',['array_criteria' => $array_criteria, 'id' => $user['id'], 'user' => $user]);
        }else{
        
        return redirect()->route('home');
        }
    }
    public function deleteSession ($id) 
    {
        $id = intval($id);
        $this->session->run(<<<'CYPHER'
        MATCH(p:Product{id: $id})- [:`Phiên giao dịch`] -> (s:Session)
        OPTIONAL MATCH (o:Order) - [:`Đặt mua`] -> (s:Session)
        DETACH DELETE p, o, s
        CYPHER,
        [
            'id' => $id
        ]);
        return redirect() -> route('listSession');
    } 

    public function deleteUsers ($id) 
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $id = intval($id);
        if($user['id'] !== $id)
        {
            $this->session->run(<<<'CYPHER'
            OPTIONAL MATCH (u:User{id: $id})
            OPTIONAL MATCH (u) - [r] -> ()
            DELETE u, r
            CYPHER,
        [
            'id' => $id
        ]);
        }
        
        return redirect() -> route('listUsers');
    } 
    public function deletecriteria(){
        $result = $this->session->run(<<<'CYPHER'
        Match(c:Criteria) detach delete c 
        return c
        CYPHER);
        if($result) return redirect()->back();
        return redirect()->back();
    }
}
