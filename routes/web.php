<?php

use App\Http\Controllers\ServiceController;
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
    return view('welcome');
});
Route::get('/invoices', [ServiceController::class,'invoices'])->name('invoices');
Route::get('/paymentsHistory', [ServiceController::class,'paymentsHistory'])->name('paymentsHistory');
Route::get('/invoice/{invoice_id}', [ServiceController::class,'invoice'])->name('invoice');
Route::resource('service',ServiceController::class);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
