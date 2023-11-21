<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class customAuthController extends Controller
{
    public function registeruser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|max:16'
        ]);
        if ($validator->fails()) {
            return redirect('/registration')->withErrors($validator)
                ->withInput();
        }


        $picUrl = $req->input('pic') ?? 'https://cdn-icons-png.flaticon.com/512/6386/6386976.png';

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'pic' => $picUrl,
        ]);

        if ($user) {
            $req->session()->put('loginID', $user->id);
            $intendedUrl = session('intended_url', '/home');
            session()->forget('intended_url'); // Clear the intended URL from the session
            return redirect($intendedUrl);
        } else {
            return redirect('/registration')->with('fail', 'An Error Occurred');
        }
    }


    public function loginuser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator)
                ->withInput();
        }
        $user = User::where('email', '=', $req->email)->first();
        if ($user) {

            if (Hash::check($req->password, $user->password)) {
                $req->session()->put('loginID', $user->id);
                $intendedUrl = session('intended_url', '/home');
                session()->forget('intended_url'); // Clear the intended URL from the session
                return redirect($intendedUrl);
                // return redirect('/home');
            } else {
                return back()->with('fail', 'Password Incorrect. Try again !!');
            }
        } else {
            return back()->with('fail', 'Email not Registered !!');
        }
    }

    public function logoutuser(Request $req)
    {
        $req->session()->pull('loginID');
        return redirect('/login')->with('success', 'Logged Out Successfully');
    }
    public function homepage()
    {
        $user = User::find(session('loginID'));

        if ($user) {
            return view('homepage', ['user' => $user]);
        } else {
            // User not found
            return 'User not found';
        }
    }
}
