<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class admincontroller extends Controller
{
    // read admin ================================================================================
    public function readadmin()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $akun = User::where('role', ['admin'])->get();

        return view('admin.read', ['user' => $user, 'akun' => $akun]);
    }
    // create admin ================================================================================
    public function createadmin()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];

        return view('admin.create', ['user' => $user]);
    }
    // action create admin ================================================================================
    public function actioncreateadmin(Request $req)
    {
        $input = $req->all();
        // validasi data
        $validator = Validator::make($req->all(), [
            'nohp' => 'required|email|unique:users,nohp',
            'password' => 'required',
            'c-password' => 'required|same:password',
            'role' => 'required|in:admin',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }
        // cek usernmae
        if (strlen($input['username']) == 0) {
            $input['username'] = 'user_' . Str::random(6);
        }

        User::create($input);
        Session::flash('success', ['create' => 'Admin register successfully!']);
        return back();
    }
    // detail admin ================================================================================
    public function detailadmin($id)
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];

        if (!is_numeric($id)) {
            Session::flash('error', ['error' => 'Id Tidak ditemukan']);
            return back();
        }

        $akun = User::where('id', $id)->first();
        // cek url sebelumnya
        $backurl = [
            'url' => url()->previous(),
            'title' => ucwords(str_replace('_', ' ', basename(parse_url(url()->previous(), PHP_URL_PATH))))
        ];
        $allowedTitles = ['Daftar Ahli', 'Daftar Petani', 'Daftar Akun'];

        if (!in_array($backurl['title'], $allowedTitles)) {
            $backurl['url'] = route('dasboard');
            $backurl['title'] = 'Dashboard';
        }

        return view('admin.detail', [
            'user' => $user,
            'data' => $akun,
            'back' => $backurl
        ]);
    }
    // update admin ================================================================================
    public function updateadmin(Request $req)
    {
        // get data
        $input = $req->all();
        $validator = Validator::make($input, [
            'nohp' => 'required|email|exists:users,nohp',
            'username' => 'required|string',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }
        User::where('email', $input['email'])->update([
            'username' => $input['username'],
        ]);
        Session::flash('success', ['Update Account' => 'Berhasil mengupdate admin :' . $input['email']]);
        return back();
    }
    // reset password admin ================================================================================
    // ====> memakai reset passwoard akun

    // delete admin ================================================================================
    public function deleteAdmin(Request $req)
    {
        $userToDelete = User::where('id', $req->id)
            ->where('role', 'admin')
            ->first();

        if (!$userToDelete) {
            return redirect()->back()->with('error', ['error' => 'User dengan ID tersebut tidak ditemukan.']);
        }

        if ($userToDelete->email === 'superadmin@haipetani.com') {
            return redirect()->back()->with('error', ['error' => 'User superadmin@haipetani.com tidak bisa dihapus.']);
        }

        if ($userToDelete->id === Auth::user()->id) {
            return redirect()->back()->with('error', ['error' => 'Anda tidak dapat menghapus diri sendiri.']);
        }


        $userToDelete->delete();

        return redirect()->back()->with('success', ['Delete ' => 'User berhasil dihapus.']);
    }
}
