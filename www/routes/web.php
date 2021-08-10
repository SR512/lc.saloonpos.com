<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\QovexController;
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
    return redirect('/login');
});

Auth::routes(['register' => true]);


Route::get('pages-login', [QovexController::class, 'index']);

Route::get('pages-login-2', [QovexController::class, 'index']);
Route::get('pages-register', [QovexController::class, 'index']);
Route::get('pages-register-2', [QovexController::class, 'index']);
Route::get('pages-recoverpw', [QovexController::class, 'index']);
Route::get('pages-recoverpw-2', [QovexController::class, 'index']);
Route::get('pages-lock-screen', [QovexController::class, 'index']);
Route::get('pages-lock-screen-2', [QovexController::class, 'index']);
Route::get('pages-404', [QovexController::class, 'index']);
Route::get('pages-500', [QovexController::class, 'index']);
Route::get('pages-maintenance', [QovexController::class, 'index']);
Route::get('pages-comingsoon', [QovexController::class, 'index']);
Route::post('login-status', [QovexController::class, 'checkStatus']);


// You can also use auth middleware to prevent unauthenticated users
Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Customer Controller Route
    Route::resource('customers',CustomerController::class);
    Route::get('customer',[CustomerController::class,'index'])->name('customer.index');

});
