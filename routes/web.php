<?php

use App\Http\Controllers\KomikController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PenyewaandetailController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('komik', KomikController::class);
Route::resource('penyewaan', PenyewaanController::class);

Route::get('penyewaandetail/{id}/create', [PenyewaandetailController::class, 'create'])->name('penyewaandetail.create');


Route::post('penyewaandetail', [PenyewaandetailController::class, 'store'])->name('penyewaandetail.store');
Route::get('penyewaandetail/{id}/list', [PenyewaandetailController::class, 'list'])->name('penyewaandetail.list');
Route::delete('penyewaandetail/{detail_id}/delete/{penyewaan_id}', [PenyewaandetailController::class, 'destroy'])->name('penyewaandetail.destroy');
Route::get('penyewaandetail/{id}/lunas', [PenyewaandetailController::class, 'setLunas'])->name('penyewaandetail.lunas');

Route::get('/search-komik', [KomikController::class, 'search'])->name('search.komik');
