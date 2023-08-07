<?php

use App\Http\Controllers\ADMIN\admincontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ADMIN\appController;
use App\Http\Controllers\ADMIN\akunController;

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

    // create faq
    // read faq
    // delete faq
    // update faq

    // read masukan
    Route::get('/masukan', [appController::class, 'readmasukan'])->name('readmasukan');

    // create event
    // read event

    // read activity
    Route::get('/user_activity', [appController::class, 'readactivity'])->name('readactivity');
});
