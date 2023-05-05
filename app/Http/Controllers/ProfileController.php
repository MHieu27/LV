<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use OpenCF\RecommenderService;
use Laudis\Neo4j\Basic\Session as BasicSession;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }

    public function index ()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        return view('profile',['user' => $user]);
    }

    public function profileOrderUser ($id)
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $checkUser = Auth::id();
        $orderUserID = intval($id);
        $myID = intval($user->id);
        $result2 = $this->session->run(<<<'CYPHER'
        MATCH (n:User{id: $orderUserID})
        MATCH (u:User{id: $myID})
        OPTIONAL MATCH (n)<-[:`Theo dõi`]-(follower:User)
        OPTIONAL MATCH (u) -[rel:`Theo dõi`] -> (n)
        RETURN n.id as id, n.Username as username, n.birthday as birthday, n.address as address, n.email as email, n.gender as gender, rel as follow, COUNT(follower) as totalFollower
        CYPHER,
        [
            'orderUserID' => $orderUserID,
            'myID' => $myID
        ]);
        $profileUsers = [];
        foreach($result2 as $result) {
            array_push($profileUsers, $result);

        }
        if($checkUser == $result['id']){
            return redirect() -> route('profile');
        }

        //return response($profileUsers);
        return view('profile2',['user' => $user, 'profileUsers' => $profileUsers]);

    }

    public function followUser ($id) 
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $orderUserID = intval($id);
        $myID = intval($user->id);

        $result = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID})
        MATCH (u2:User{id: $orderUserID})
        OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        WITH u, u2, rel
        WHERE rel IS NULL
        CREATE (u) - [r:`Theo dõi`] -> (u2)
        RETURN u, u2, r as follow;
        CYPHER,
        [
            'myID' => $myID,
            'orderUserID' => $orderUserID,
        ]);
        // MATCH (u:User{id: $myID})
        // MATCH (u2:User{id: $orderUserID})
        // OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        // WITH u, u2, rel
        // WHERE rel IS NULL
        // CREATE (u) - [r:`Theo dõi`] -> (u2)
        // RETURN u, u2, r as follow;

        // $checkFollow = [];
        // foreach($result as $value){
        //     array_push($checkFollow, $value);
        // }


        // MATCH (u:User {id: 9}),(u2:User {id: 2})
        // CALL {
        // OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        // WITH u, u2, rel
        // WHERE rel IS NULL
        // CREATE (u) - [r:`Theo dõi`] -> (u2)
        // }
        // CALL {
        // OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        // WITH u, u2, rel
        // WHERE rel IS NOT NULL
        // DELETE rel
        // }
        // RETURN u, u2;
        //return($result);
        return redirect() -> route('profile2', ['id' => $orderUserID]);
    }

    public function unFollowUser ($id)
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        $orderUserID = intval($id);
        $myID = intval($user->id);

        $result = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID})
        MATCH (u2:User{id: $orderUserID})
        OPTIONAL MATCH (u) - [rel:`Theo dõi`] -> (u2)
        WITH u, u2, rel
        WHERE rel IS NOT NULL
        DELETE rel
        RETURN u, u2
        CYPHER,
        [
            'myID' => $myID,
            'orderUserID' => $orderUserID,
        ]);

        return redirect() -> route('profile2', ['id' => $orderUserID]);
    }


}
