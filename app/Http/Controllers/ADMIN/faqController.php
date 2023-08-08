<?php

namespace App\Http\Controllers\ADMIN;

use App\Models\faq;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class faqController extends Controller
{
    // read faq
    public function readfaq()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $faq = faq::all();
        // return var_dump($faq);
        return view('faq.read', ['user' => $user, 'faq' => $faq]);
    }
    // create faq
    public function createfaq()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];

        return view('faq.create', ['user' => $user]);
    }
    public function actioncreatefaq(Request $req)
    {
        $input = $req->all();
        $validator = Validator::make($input, [
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:pertanian,perternakan,teknologi,pasar,lingkungan',
            'ciri2' => 'required|string',
            'solusi' => 'required|string',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }
        faq::create($input);
        Session::flash('success', ['Create FAQ' => 'Berhasil membuat FAQ baru!']);
        return back();
    }
    // detail faq
    public function detailfaq($id)
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $faq = faq::where('id', $id)->first();
        if (!$faq) {
            return redirect()->back()->with('error', ['error' => 'FAQ dengan ID tersebut tidak ditemukan.']);
        }
        // cek url sebelumnya
        $backurl = [
            'url' => url()->previous(),
            'title' => ucwords(str_replace('_', ' ', basename(parse_url(url()->previous(), PHP_URL_PATH))))
        ];
        $allowedTitles = ['Daftar FAQ',];

        if (!in_array($backurl['title'], $allowedTitles)) {
            $backurl['url'] = route('dasboard');
            $backurl['title'] = 'Dashboard';
        }

        return view('faq.detail', [
            'user' => $user,
            'data' => $faq,
            'back' => $backurl
        ]);
    }
    // update faq
    public function updatefaq(Request $req)
    {
        $input = $req->all();
        $validator = Validator::make($input, [
            'id' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:pertanian,perternakan,teknologi,pasar,lingkungan',
            'ciri2' => 'required|string',
            'solusi' => 'required|string',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }
        $faq = faq::find($input['id']);
        if (!$faq) {
            return redirect()->back()->with('error', ['error' => 'FAQ dengan ID tersebut tidak ditemukan.']);
        }

        $faq->update($input);
        Session::flash('success', ['Create FAQ' => 'Berhasil membuat FAQ baru!']);
        return back();
    }
    // delete faq
    public function deletefaq(Request $req)
    {
        $faqToDelete = faq::where('id', $req->id)
            ->first();

        if (!$faqToDelete) {
            return redirect()->back()->with('error', ['error' => 'FAQ dengan ID tersebut tidak ditemukan.']);
        }

        $faqToDelete->delete();

        return redirect()->back()->with('success', ['Delete ' => 'FAQ berhasil dihapus.']);
    }
}
