<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Auth;
use App\User;

class LoginController extends Controller
{
    public function login(Request $r)
    {
        $muser = $r->email;
        $mpass = md5($r->password);
        $user = User::where('memail', $muser)->first();

        if (!empty($user) && $mpass == $user->mpassword) {
            // login success
            Auth::loginUsingId($user->mid);
            $user->countlogin = $user->countlogin + 1;
            $user->save();
            return redirect('/')->with('status', 'Profile updated !');
        } else if (empty($user)) {
            return back()->with('status', 'User not found !');
        } else {
            return back()->with('status', 'Password not match !');
        }	
    }

    public function logout()
    {
        // logout
        Session::flush();

        return redirect('login');
    }
}
