<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\User;
use App\Models\u_ahli;
use App\Models\u_petani;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class akuncontroller extends Controller
{
    // read akun
    public function readakun()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $petani = u_petani::join('users', 'u_petanis.email', '=', 'users.email')->get();
        $ahli = u_ahli::join('users', 'u_ahlis.email', '=', 'users.email')->get();
        $akun = $petani->merge($ahli);

        return view('akun.readakun', ['user' => $user, 'akun' => $akun]);
    }

    // create akun
    public function createakun()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];

        return view('akun.tambah', ['user' => $user]);
    }

    public function actioncreateakun(Request $req)
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $input = $req->all();
        // validasi data
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c-password' => 'required|same:password',
            'role' => 'required|in:petani,ahli',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }
        // cek usernmae
        if (strlen($input['username']) == 0) {
            $input['username'] = 'user_' . Str::random(6);
        }
        // buat akun
        $user = User::create($input);
        // buat tabel data user
        switch ($req->role) {
            case 'petani':
                $petani = u_petani::create($input);
                break;
            case 'ahli':
                $ahli = u_ahli::create($input);
                break;
            default:
                return back()->with('error', ['error' => 'Undifined Role']);;
                break;
        }
        Session::flash('success', ['create' => 'User register successfully!']);
        return back();
    }

    // read ahli
    public function readahli()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $ahli = u_ahli::join('users', 'u_ahlis.email', '=', 'users.email')->get();

        return view('akun.readahli', ['user' => $user, 'akun' => $ahli]);
    }
    // delete ahli
    // update ahli

    // read petani
    public function readpetani()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $petani = u_petani::join('users', 'u_petanis.email', '=', 'users.email')->get();

        return view('akun.readpetani', ['user' => $user, 'akun' => $petani]);
    }
    // delete petani
    // update petani

    // read admin
    // create admin
    // update admin 
}
