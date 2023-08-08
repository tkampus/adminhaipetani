<?php

use App\Http\Controllers\ADMIN\admincontroller;
use App\Http\Controllers\ADMIN\faqController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ADMIN\appController;
use App\Http\Controllers\ADMIN\akunController;
use App\Http\Controllers\ADMIN\eventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// login
Route::get('/login', [appController::class, 'login'])->name('login');
Route::post('/actionlogin', [appController::class, 'actionlogin'])->name('actionlogin');
//logout
Route::get('/logout', [appController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'admin']], function () {
    // dasboard
    Route::get('/', [appController::class, 'dasboard'])->name('dasboard');

    // create akun
    Route::get('/Buat_Akun', [akunController::class, 'createakun'])->name('createakun');
    Route::post('/Buat_Akun', [akunController::class, 'actioncreateakun'])->name('actioncreateakun');
    // read akun
    Route::get('/Daftar_Akun', [akunController::class, 'readakun'])->name('readakun');
    Route::get('/Daftar_Ahli', [akunController::class, 'readahli'])->name('readahli');
    Route::get('/Daftar_Petani', [akunController::class, 'readpetani'])->name('readpetani');
    // delete akun
    Route::post('/Hapus_Akun', [akunController::class, 'deleteakun'])->name('deleteakun');
    // update akun
    Route::post('/Update_Akun', [akunController::class, 'updateakun'])->name('updateakun');
    // detail akun
    Route::get('/Detail:{id}', [akunController::class, 'detailakun'])->name('detailakun');
    // reset pasword akun
    Route::post('/Reset_Password', [akunController::class, 'gantipasswordakun'])->name('gantipasswordakun');

    // read admin
    Route::get('/Daftar_Admin', [admincontroller::class, 'readadmin'])->name('readadmin');
    // create admin
    Route::get('/Buat_Admin', [admincontroller::class, 'createadmin'])->name('createadmin');
    // action create admin
    Route::post('/Buat_Admin', [admincontroller::class, 'actioncreateadmin'])->name('actioncreateadmin');
    // detail admin
    Route::get('/Detail_Admin:{id}', [adminController::class, 'detailadmin'])->name('detailadmin');
    // update admin
    Route::post('/Update_Admin', [admincontroller::class, 'updateadmin'])->name('updateadmin');
    // reset password
    // delete admin
    Route::post('/Hapus_Admin', [admincontroller::class, 'deleteadmin'])->name('deleteadmin');

    // read faq
    Route::get('/Daftar_FAQ', [faqcontroller::class, 'readfaq'])->name('readfaq');
    // create faq
    Route::get('/Buat_FAQ', [faqcontroller::class, 'createfaq'])->name('createfaq');
    Route::post('/Buat_FAQ', [faqcontroller::class, 'actioncreatefaq'])->name('actioncreatefaq');
    // delete faq
    Route::post('/Hapus_FAQ', [faqcontroller::class, 'deletefaq'])->name('deletefaq');
    // detail faq
    Route::get('/Detail_FAQ:{id}', [faqcontroller::class, 'detailfaq'])->name('detailfaq');
    // update faq
    Route::post('/Update_FAQ', [faqcontroller::class, 'updatefaq'])->name('updatefaq');

    // read masukan
    Route::get('/masukan', [appController::class, 'readmasukan'])->name('readmasukan');

    // read event
    Route::get('/Daftar_Event', [eventcontroller::class, 'readevent'])->name('readevent');
    // create event
    Route::get('/Buat_Event', [eventcontroller::class, 'createevent'])->name('createevent');
    Route::post('/Buat_Event', [eventcontroller::class, 'actioncreateevent'])->name('actioncreateevent');
    // delete event
    Route::post('/Hapus_Event', [eventcontroller::class, 'deleteevent'])->name('deleteevent');
    // detail event
    Route::get('/Detail_Event:{id}', [eventcontroller::class, 'detailevent'])->name('detailevent');
    // update event
    Route::post('/Update_Event', [eventcontroller::class, 'updateevent'])->name('updateevent');

    // read activity
    Route::get('/user_activity', [appController::class, 'readactivity'])->name('readactivity');
});
