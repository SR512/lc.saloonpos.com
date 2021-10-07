<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\QovexController;
use Illuminate\Support\Facades\Artisan;
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
    Route::resource('customers', CustomerController::class);
    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('find/customer', [CustomerController::class, 'findCustomer'])->name('customer.search');

    // Employee Controller Route
    Route::resource('employees', \App\Http\Controllers\Admin\EmployeeController::class);
    Route::get('employee', [\App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('employee.index');

    // Appointment Controller Route
    Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class);
    Route::get('appointment', [\App\Http\Controllers\Admin\AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('appointment/{id}/{status}', [\App\Http\Controllers\Admin\AppointmentController::class, 'changeStatus'])->name('appointment.status');


    // Servcie Controller Route
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::get('service', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('service.index');


    // Expense Controller Route
    Route::resource('expenses', \App\Http\Controllers\Admin\ExpenseController::class);
    Route::get('expense', [\App\Http\Controllers\Admin\ExpenseController::class, 'index'])->name('expense.index');

    // Product Controller Route
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::get('product', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.index');

    // Attribute Controller Route
    Route::resource('attributes', \App\Http\Controllers\Admin\AttributeController::class);
    Route::get('attribute', [\App\Http\Controllers\Admin\AttributeController::class, 'index'])->name('attribute.index');

    // Invoice Controller Route
    Route::resource('invoices', \App\Http\Controllers\Admin\InvoiceController::class);
    Route::get('invoice', [\App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('invoice.index');

    // Seller Invoice Controller Route
    Route::resource('sellerinvoices', \App\Http\Controllers\Admin\SellerInvoiceController::class);
    Route::get('sellerinvoice', [\App\Http\Controllers\Admin\SellerInvoiceController::class, 'index'])->name('sellerinvoice.index');

    // Setting Controller Route
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);
    Route::get('setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');

    // Report Controller Route
    Route::get('report', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('report.index');
    Route::post('report/expense', [\App\Http\Controllers\Admin\ReportController::class, 'exportExpense'])->name('expense.report.index');

    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
    });
});
