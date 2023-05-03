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

    public function profileOrderUser ($username)
    {
        $result2 = $this->session->run(<<<'CYPHER'
        MATCH (n:User)
        WHERE n.Username = $username
        RETURN n
        CYPHER,
        [
            'username' => $username
        ]);
        foreach($result2 as $result) {
            $getValue = $result['n']['properties'];
            $getUsername = $getValue['Username'];
            $getAddress = $getValue['address'];
            $getBirthday = $getValue['birthday'];
            $getGender = $getValue['gender'];

        }
        $user = new UserResource(User::findOrFail(Auth::id()));
        return view('profile2',['user' => $user, 'username' => $getUsername, 'address' => $getAddress, 'birthday' => $getBirthday, 'gender' => $getGender]);

    }

}
