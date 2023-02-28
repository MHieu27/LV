<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
/*         dd($user->get()); */

        return view('index',['user' => $user]);
    }
}
