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
}
