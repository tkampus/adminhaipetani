<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\User;
use App\Models\u_ahli;
use App\Models\u_petani;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class akuncontroller extends Controller
{
    // read akun ================================================================================
    public function readakun()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $akun = User::whereNotIn('role', ['admin'])->get();

        return view('akun.readakun', ['user' => $user, 'akun' => $akun]);
    }

    // create akun ================================================================================
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
        $input = $req->all();
        // validasi data
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c-password' => 'required|same:password',
            'role' => 'required|in:petani,ahli',
        ]);
        if ($validator->fails()) {
            // return var_dump($validator->errors());
            Session::flash('error', $validator->errors()->toArray());
            // return $validator->errors()->toArray();
            return back();
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
                Session::flash('error', ['error' => 'Undifined Role']);
                return back();
                break;
        }
        Session::flash('success', ['create' => 'User register successfully!']);
        return back();
    }

    // read ahli ================================================================================
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

    // read petani ================================================================================
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
    // detail akun ================================================================================
    public function detailakun($id)
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

        $data = User::where('id', $id)->first();
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

        // Cek jika user berperan sebagai "ahli"
        if ($data->role === 'ahli') {
            $ahliData = u_ahli::join('users', 'u_ahlis.email', '=', 'users.email')
                ->where('users.email', $data->email)
                ->select('users.username', 'users.role', 'u_ahlis.*')
                ->first();

            if ($ahliData) {
                $data = $ahliData;
            }
        }
        // Cek jika user berperan sebagai "petani"
        if ($data->role === 'petani') {
            $petaniData = u_petani::join('users', 'u_petanis.email', '=', 'users.email')
                ->where('users.email', $data->email)
                ->select('users.username', 'users.role', 'u_petanis.*')
                ->first();

            if ($petaniData) {
                $data = $petaniData;
            }
        }
        return view('akun.detailakun', [
            'user' => $user,
            'data' => $data,
            'back' => $backurl
        ]);
    }
    // update akun ================================================================================
    public function updateakun(Request $req)
    {
        // get data
        $input = $req->all();
        if (isset($input['password'])) {
            unset($input['password']);
        }
        if (isset($input['c-password'])) {
            unset($input['c-password']);
        }
        if (isset($input['role'])) {
            unset($input['role']);
        }
        $validator = Validator::make($input, [
            'email' => 'required|string|email',
            'username' => 'required|string',
            'telp' => 'nullable',
            'nik' => 'nullable',
            'jeniskelamin' => 'required|string|in:laki-laki,perempuan',
            'tanggallahir' => 'nullable',
            'alamat' => 'nullable',
            'nip' => 'nullable',
            'keahlian1' => 'nullable|string',
            'keahlian2' => 'nullable|string',
            'kantor' => 'nullable',
        ]);
        if ($validator->fails()) {
            // return var_dump($validator->errors());
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }
        $user = User::where('email', $input['email'])->first();
        if ($user) {
            // Update data di model User
            $user->update([
                'username' => $input['username'],
            ]);

            // Cek role dan update data di model yang sesuai
            if ($user->role === 'petani') {
                $uPetani = u_petani::where('email', $input['email'])->update([
                    'telp' => $input['telp'] ?? '',
                    'nik' => $input['nik'] ?? '',
                    'jeniskelamin' => $input['jeniskelamin'] ?? 'laki-laki',
                    'tanggallahir' => $input['tanggallahir'] ?? date('Y-m-d'),
                    'alamat' => $input['alamat'] ?? ''
                ]);
                // return $uPetani;
            } elseif ($user->role === 'ahli') {
                $uAhli = u_ahli::where('email', $input['email'])->update([
                    'telp' => $input['telp'] ?? '',
                    'nik' => $input['nik'] ?? '',
                    'jeniskelamin' => $input['jeniskelamin'] ?? 'laki-laki',
                    'tanggallahir' => $input['tanggallahir'] ?? date('Y-m-d'),
                    'alamat' => $input['alamat'] ?? '',
                    'nip' => $input['nip'] ?? '',
                    'keahlian1' => $input['keahlian1'] ?? '',
                    'keahlian2' => $input['keahlian2'] ?? '',
                    'kantor' => $input['kantor'] ?? '',
                ]);
                // return $uAhli;
            }
        } else {
            Session::flash('error', ['error' => 'Email tidak ditemukan!']);
            return back();
        }
        Session::flash('success', ['Update Account' => 'Berhasil mengipdate akun:' . $input['email']]);
        return back();
    }
    // ganti passsword ================================================================================
    public function gantipasswordakun(Request $req)
    {
        $input = $req->all();
        $validator = Validator::make($req->all(), [
            'l-password' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'c-password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }
        // return $input;
        // Logika untuk memeriksa apakah l-password benar
        $user = User::where('email', $req->email)->first();
        if (!Hash::check($req->input('l-password'), $user->password)) {
            Session::flash('error', ['l-password' => 'Password lama salah.']);
            return back()->withErrors(['l-password' => 'Password lama salah.'])->withInput();
        }

        // Ubah password menjadi yang baru
        $user->password = Hash::make($req->input('password'));
        $user->save();

        Session::flash('success', 'Password berhasil diubah.');
        return back();
    }

    // delete akun ================================================================================
    public function deleteakun(Request $req)
    {
        $userToDelete = User::find($req->id);
        if (!$userToDelete) {
            Session::flash('error', ['error' => 'User dengan ID tersebut tidak ditemukan.']);
            return back();
        }
        $userToDelete->delete();

        Session::flash('success', ['User' => 'User berhasil dihapus.']);
        return back();
    }
}
