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

        return view('akun.create', ['user' => $user]);
    }

    public function actioncreateakun(Request $req)
    {
        $input = $req->all();
        // validasi data
        $validator = Validator::make($req->all(), [
            'nohp' => 'required|string|regex:/^\d{10,12}$/|unique:users,nohp',
            'username' => 'required|string',
            'email' => 'nullable|email',
            'nik' => 'nullable',
            'jeniskelamin' => 'required|string|in:laki-laki,perempuan',
            'tanggallahir' => 'nullable',
            'alamat' => 'nullable',
            'bintang' => 'nullable',
            'nip' => 'nullable',
            'keahlian1' => 'nullable|string',
            'keahlian2' => 'nullable|string',
            'kantor' => 'nullable',
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
        $ahli = u_ahli::join('users', 'u_ahlis.nohp', '=', 'users.nohp')->get();

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
        $petani = u_petani::join('users', 'u_petanis.nohp', '=', 'users.nohp')->get();

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
            $ahliData = u_ahli::join('users', 'u_ahlis.nohp', '=', 'users.nohp')
                ->where('users.nohp', $data->nohp)
                ->select('users.username', 'users.role', 'u_ahlis.*')
                ->first();

            if ($ahliData) {
                $data = $ahliData;
            }
        }
        // Cek jika user berperan sebagai "petani"
        if ($data->role === 'petani') {
            $petaniData = u_petani::join('users', 'u_petanis.nohp', '=', 'users.nohp')
                ->where('users.nohp', $data->nohp)
                ->select('users.username', 'users.role', 'u_petanis.*')
                ->first();

            if ($petaniData) {
                $data = $petaniData;
            }
        }
        return view('akun.detail', [
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
            'nohp' => 'required|string|regex:/^\d{10,12}$/',
            'username' => 'required|string',
            'email' => 'nullable|email',
            'nik' => 'nullable',
            'jeniskelamin' => 'required|string|in:laki-laki,perempuan',
            'tanggallahir' => 'nullable',
            'alamat' => 'nullable',
            'bintang' => 'nullable',
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
        $user = User::where('nohp', $input['nohp'])->first();
        if ($user) {
            // Update data di model User
            $user->update([
                'username' => $input['username'],
            ]);

            // Cek role dan update data di model yang sesuai
            if ($user->role === 'petani') {
                $uPetani = u_petani::where('nohp', $input['nohp'])->update([
                    'email' => $input['email'] ?? '',
                    'nik' => $input['nik'] ?? '',
                    'jeniskelamin' => $input['jeniskelamin'] ?? 'laki-laki',
                    'tanggallahir' => $input['tanggallahir'] ?? date('Y-m-d'),
                    'alamat' => $input['alamat'] ?? ''
                ]);
                // return $uPetani;
            } elseif ($user->role === 'ahli') {
                $uAhli = u_ahli::where('nohp', $input['nohp'])->update([
                    'email' => $input['email'] ?? '',
                    'nik' => $input['nik'] ?? '',
                    'jeniskelamin' => $input['jeniskelamin'] ?? 'laki-laki',
                    'tanggallahir' => $input['tanggallahir'] ?? date('Y-m-d'),
                    'alamat' => $input['alamat'] ?? '',
                    'bintang' => $input['bintang'] ?? '',
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
        Session::flash('success', ['Update Account' => 'Berhasil mengupdate akun:' . $input['nohp']]);
        return back();
    }
    // ganti passsword ================================================================================
    public function gantipasswordakun(Request $req)
    {
        $input = $req->all();
        $validator = Validator::make($req->all(), [
            'l-password' => 'required',
            'nohp' => 'required|regex:/^\d{10,12}$/|exists:users,nohp',
            'password' => 'required',
            'c-password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }
        // return $input;
        // Logika untuk memeriksa apakah l-password benar
        $user = User::where('nohp', $req->nohp)->first();
        if (!Hash::check($req->input('l-password'), $user->password)) {
            Session::flash('error', ['l-password' => 'Password lama salah.']);
            return back()->withErrors(['l-password' => 'Password lama salah.'])->withInput();
        }

        // Ubah password menjadi yang baru
        $user->password = Hash::make($req->input('password'));
        $user->save();

        Session::flash('success', ['change password' => 'Password berhasil diubah.']);
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
