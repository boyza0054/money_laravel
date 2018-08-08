<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Carbon\Carbon;

class UserController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list()
    {   
        $user = User::where('mdelete',0)->get();
        return view('pages.users.list')->with('list',$user);
    }
    public function create()
    {
        return view('pages.users.create');
    }
    public function insert(Request $r)
    {
        $mpic = $r->mpic;
        $firstname = $r->firstname;
        $lastname = $r->lastname;
        $email = $r->email;
        $phonenumber = $r->phonenumber;
        $midcard = $r->midcard;
        $role_id = $r->role_id;
        $gender = $r->gender;
        $brithdate = $r->brithdate;
        $address = $r->address;
        $password = $r->password;
        $repassword = $r->repassword;
        $age = Carbon::parse($brithdate)->age;

        $user = new User();
        $user->mname = $firstname;
        $user->mlastname = $lastname;
        $user->memail = $email;
        $user->mtel = $phonenumber;
        $user->midcard = $midcard;
        $user->mstatus = $role_id;
        $user->mbirthday = $brithdate;
        $user->mpassword = md5($password);
        $user->mage = $age;
        $user->msex = $gender;
        $user->maddress = $address;
        $user->mpic = $mpic;
        $user->save();
        
        return redirect('users/list')->with('status','Success! message sent successfully.');
    }
    public function edit(Request $r)
    {   
        $user = User::where('mid',$r->id)->first();
        return view('pages.users.info')->with('list',$user);
    }
    public function update(Request $r)
    {   
        $mpic = $r->mpic;
        $firstname = $r->firstname;
        $lastname = $r->lastname;
        $email = $r->email;
        $phonenumber = $r->phonenumber;
        $midcard = $r->midcard;
        $role_id = $r->role_id;
        $gender = $r->gender;
        $brithdate = $r->brithdate;
        $address = $r->address;
        $age = Carbon::parse($brithdate)->age;

        $user = User::where('mid',$r->id)->first();
        $user->mname = $firstname;
        $user->mlastname = $lastname;
        $user->memail = $email;
        $user->mtel = $phonenumber;
        $user->midcard = $midcard;
        $user->mstatus = $role_id;
        $user->mbirthday = $brithdate;
        $user->mage = $age;
        $user->msex = $gender;
        $user->maddress = $address;
        if($mpic != ""){
            $user->mpic = $mpic;
        }
        $user->save();
        
        return back()->with('status','Success! message sent successfully.');
    }
    public function destroy(Request $r)
    {   
        $user = User::where('mid',$r->user_id)->first();
        $user->mdelete = 1;
        $user->save();
        return back()->with('status','Success! message sent successfully.');
    }
    public function checkemail(Request $r)
    {
        $user = User::where('memail',$r->email)->first();
        if(count($user) > 0){
            return '1';
        }else{
            return '0';
        }
    }
}
