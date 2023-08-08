<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class eventController extends Controller
{
    // read event
    public function readevent()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        return view('app.error', ['user' => $user]);
    }
    // create event
    public function createevent()
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        return view('app.error', ['user' => $user]);
    }
    public function actioncreateevent(Request $req)
    {
    }
    // detail event
    public function detail_event($id)
    {
    }
    // update event
    public function updateevent(Request $req)
    {
    }
    // delete event
    public function deleteevent(Request $req)
    {
    }
}
