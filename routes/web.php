<?php

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


    Route::get('/', 'LoginController@index');
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login');
    Route::get('/dashboard', 'DashboardController@index');
    Route::resource('/supplier', 'SupplierController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/medicine', 'MedicineController');
    Route::resource('/customer', 'CustomerController');
