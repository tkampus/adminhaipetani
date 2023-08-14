<?php

namespace App\Http\Controllers\ADMIN;

use Exception;
use App\Models\event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
        $event = event::all();
        return view('event.read', ['user' => $user, 'event' => $event]);
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
        return view('event.create', ['user' => $user]);
    }
    public function actioncreateevent(Request $req)
    {
        $input = $req->all();
        $validator = Validator::make($req->all(), [
            'judul' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'link' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }

        $imagePath = $req->file('gambar')->getPathname();
        $imageData = file_get_contents($imagePath);

        // return $validatedData;
        try {
            event::create([
                'judul' => $input['judul'],
                'gambar' => $imageData,
                'conten' => $input['content'],
                'link' => $input['link'],
            ]);
        } catch (Exception $e) {
            Session::flash(
                'error',
                ['error' => 'Terjadi kesalahan saat menyimpan gambar']
            );
            return back();
        }
        Session::flash('success', ['Create Event' => 'Berhasil membuat event baru']);
        return back();
    }
    // image event
    public function getimage($id)
    {
        $event = event::find($id);
        return Response::make($event->gambar, 200, [
            'Content-Type' => 'image/jpeg',
            'Content-Disposition' => 'inline; filename="' . $event->judul . '.jpeg"',
        ]);
    }
    // detail event
    public function detailevent($id)
    {
        // get data
        $user = [
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role
        ];
        $event = event::where('id', $id)->first();
        if (!$event) {
            return redirect()->back()->with('error', ['error' => 'Event dengan ID tersebut tidak ditemukan.']);
        }

        $active = false; // Defaultnya tidak aktif
        $latestEvent = Event::latest('id')->first();

        $backurl = [
            'url' => url()->previous(),
            'title' => ucwords(str_replace('_', ' ', basename(parse_url(url()->previous(), PHP_URL_PATH))))
        ];
        $allowedTitles = ['Daftar Event',];

        if (!in_array($backurl['title'], $allowedTitles)) {
            $backurl['url'] = route('dasboard');
            $backurl['title'] = 'Dashboard';
        }

        return view('event.detail', [
            'user' => $user,
            'data' => $event,
            'back' => $backurl,
            'active' => $active
        ]);
    }
    // update event
    public function updateevent(Request $req)
    {
        $input = $req->all();
        $validator = Validator::make($req->all(), [
            'judul' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'link' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->toArray());
            return back();
        }

        // Dapatkan ID event dari input
        $eventId = $input['id'];

        // Cari data event berdasarkan ID
        $event = event::find($eventId);
        if (!$event) {
            Session::flash('error', ['error' => 'Event dengan ID tersebut tidak ditemukan.']);
            return back();
        }

        // Update data event
        $eventData = [
            'judul' => $input['judul'],
            'content' => $input['content'],
            'link' => $input['link'],
        ];

        // Cek apakah ada gambar yang di-upload
        if ($req->hasFile('gambar')) {
            $imagePath = $req->file('gambar')->getPathname();
            $imageData = file_get_contents($imagePath);
            $eventData['gambar'] = $imageData;
        }

        try {
            // Update data event dengan data yang sudah disiapkan
            $event->update($eventData);

            Session::flash('success', ['Update Event' => 'Berhasil mengupdate event.']);
            return back();
        } catch (\Exception $e) {
            Session::flash('error', ['error' => 'Gagal mengupdate event.', 'gambar' => 'Gambar yang diinputkan bermasalah!']);
            return back();
        }
    }
    // delete event
    public function deleteevent(Request $req)
    {
        $eventToDelete = event::where('id', $req->id)->first();
        if (!$eventToDelete) {
            return redirect()->back()->with('error', ['error' => 'Event dengan ID tersebut tidak ditemukan.']);
        }
        $eventToDelete->delete();

        return redirect()->back()->with('success', ['Delete ' => 'Event berhasil dihapus.']);
    }

    public function updateeventactive(Request $req)
    {
        $idToMove = $req->id;

        $eventToMove = Event::find($idToMove);
        $maxId = Event::max('id');

        if ($eventToMove && $maxId !== null) {
            // Update data with the target ID to the maximum ID + 1
            Event::where('id', $idToMove)->update([
                'id' => $maxId + 1,
            ]);

            // Delete the data with the original target ID
            Event::destroy($idToMove);
            return redirect()->route('readevent')->with('success', ['Delete ' => 'Event berhasil dihapus.']);
        } else {
            return redirect()->route('readevent')->with('error', ['error' => 'Event dengan ID tersebut tidak ditemukan.']);
        }
    }
}
