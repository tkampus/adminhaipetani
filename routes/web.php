<?php

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
Route::get('/logout', [appController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'admin']], function () {
    // dasboard
    Route::get('/', [appController::class, 'dasboard'])->name('dasboard');
    //logout

    // create akun
    Route::get('/Buat_Akun', [akunController::class, 'createakun'])->name('createakun');
    Route::post('/Buat_Akun', [akunController::class, 'actioncreateakun'])->name('actioncreateakun');
    // read akun
    Route::get('/Daftar_Akun', [akunController::class, 'readakun'])->name('readakun');
    Route::get('/Daftar_Ahli', [akunController::class, 'readahli'])->name('readahli');
    Route::get('/Daftar_Petani', [akunController::class, 'readpetani'])->name('readpetani');
    // delete akun
    // update akun

    // read admin
    // delete admin
    // update admin

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
