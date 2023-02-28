<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getlogin(){
        /* if(Auth::id()){
            return redirect()->route('home');
        } */
        return view('login');
    }
    public function create(Request $request)
    {
/*         $request->validate([
            'user.email' => 'required|email:rfc',
            'user.username' => 'required|string|unique:User,email|min:3|max:50',
            'user.password' => ['required', ...$this->passwordValidationRules()]
        ]); */

        $user = $request->all();
        $user['passwordHash'] = Hash::make($user['password']);
        $check_username = User::query()->where('username', $user['username'])->first();
        if($check_username != null){
            Session::flash('message', 'Ten da ton tai!');
            return redirect()->back();
        }
        $user = User::create(Arr::only($user, ['email', 'username', 'passwordHash']));
        return redirect()->route('login');
    /*     return (new UserResource($user))
            ->toResponse($request)
            ->setStatusCode(201); */
    }
    public function login(Request $request)
    {
/*         $request->validate([
            'user.email' => 'required|email:rfc',
            'user.password' => 'required|max:255'
        ]); */

        $credentials = $request->all();
        $user = User::query()->where('email', $credentials['email'])->first();
/*         dd($user    ); */
        if ($user === null || !Hash::check($credentials['password'], $user->getAttribute('passwordHash'))) {
            Session::flash('message', 'This is a message!');
            return redirect()->back();
        }
/*         new UserResource($user); */
        Auth::login($user);
        new UserResource($user);
     /*    return  $result; */
        return redirect()->route('home');
    }

}
