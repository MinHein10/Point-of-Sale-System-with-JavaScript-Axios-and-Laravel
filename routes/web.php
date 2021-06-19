<?php

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

Route::get('/pos',function(){
    return view('adminpanel.templates.dashboard');
})->name('dashboard.admin');

Route::resource('/orders','OrderController');
Route::resource('/order-details','OrderDetailController');
Route::resource('/products','ProductController');
Route::resource('/suppliers','SupplierController');
Route::resource('/users','UserController');
Route::resource('/companies','CompanyController');
Route::resource('/transactions','TransactionController');



