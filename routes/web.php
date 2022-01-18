<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistroyTransaksiController;
use App\Http\Controllers\TransaksiAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('transaksi', TransaksiAdminController::class);
Route::get('transaksi/{action}/{id}', [TransaksiAdminController::class, 'actiontransaksi'])->name('transaksi.actiontransaksi');
Route::resource('history', HistroyTransaksiController::class);
Route::get('history/{action}/{id}', [HistroyTransaksiController::class, 'actionhistory'])->name('history.actionhistory');
