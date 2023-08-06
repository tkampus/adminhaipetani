<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\masukan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\chat;

class appController extends Controller
{
    // dasboard
    public function dasboard()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        // var_dump($datas);
        // view
        return view('app.dasboard', ['user' => $user]);
    }
    // login
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('app/login');
        }
    }
    public function actionlogin(Request $req)
    {
        $data = [
            'email' => $req->input('email'),
            'password' => $req->input('password'),
            'role' => 'admin'
        ];
        if (Auth::Attempt($data)) {
            return redirect()->intended('/');
        } else {
            return back()->with('error', 'Email atau Password Salah');
        }
    }
    // logout
    public  function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // read masukan
    public function readmasukan()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $masukan = masukan::all();
        return view('app.masukan', ['user' => $user, 'masukan' => $masukan]);
    }

    // read log activity
    public function readactivity()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        return view('app.logactivity', ['user' => $user]);
    }
}
