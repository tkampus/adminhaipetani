<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\chat;
use App\Models\user;
use App\Models\u_ahli;
use App\Models\masukan;
use App\Models\u_petani;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $loginnow =
            DB::table('personal_access_tokens')
            ->whereDate('last_used_at', Carbon::today())
            ->count();
        $data = [
            'admin' => User::where('role', 'admin')->count(), // berisikan jumlah user denagnb role admin
            'ahli' => u_ahli::count(), //berisikan jumlah user yang ada dalam tabel u_ahli
            'petani' => u_petani::count(), //berisikan jumlah user yang ada dalam tabel u_petani
            'chatnow' => chat::whereDate('created_at', today())->count(), // berisikan jumlah user yang melakuka chat hari ini
            'loginnow' => $loginnow
        ];
        // view
        return view('app.dasboard', ['user' => $user, 'data' => $data]);
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
        return view('app.error', ['user' => $user]);
    }

    // function testing
    public function tespost(Request $req)
    {
        return var_dump($req->all());
        return $req->all();
    }
}
