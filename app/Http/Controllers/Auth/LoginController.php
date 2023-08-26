<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function guestLogin() 
    {
        $guestUserId = 1;
        $user = User::find($guestUserId);
        if($user) {
            Auth::login($user);
            return redirect('/index');
        } else {
            return redirect('/');
        }
    }

    public function index() 
    {
        return view('index');
    }
}
