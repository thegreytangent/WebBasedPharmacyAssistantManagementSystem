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


	// Route::group(['prefix' => 'pharmacy'], function () {


		Route::get('/', function () {
			return view('welcome');
		});
		
		Route::group(['prefix' => 'customer'], function () {
			Route::get('purchase', 'CustomerPurchaseController@index');
		});
	
	
		Route::get('/', 'LoginController@index');
		Route::get('/login', 'LoginController@index');
		Route::post('/login', 'LoginController@login');
		
		Route::get('/api/purchase-pharmacy/inventories', 'PurchasePharmacyController@getInventories');
		
		Route::group(['middleware' => 'auth'], function (){
			Route::get('/dashboard', 'DashboardController@index');
			Route::resource('/supplier', 'SupplierController');
			Route::get('/supplier/medicines/{supplier_id}', 'SupplierController@getMedicines');
			Route::resource('/category', 'CategoryController');
			Route::resource('/medicine', 'MedicineController');
			
			Route::resource('/order', 'OrderController');
			Route::resource('/purchase', 'PurchaseController');
			Route::delete('/purchase-delete', 'PurchaseController@deleteAll');
			Route::get('/purchase-pharmacy', 'PurchasePharmacyController@index');
			Route::post('/api/purchase-pharmacy', 'PurchasePharmacyController@store');
			
			Route::resource('/purchase-medicine', 'PurchaseMedicineController');
			Route::get('/inventory', 'InventoryController@index');
			Route::get('/inventory-print', 'InventoryController@print');
			Route::get('/logout', 'AuthController@logout');
			Route::get('/purchase-report', 'ReportController@purchase');
		});
		
	
		Route::resource('/customer', 'CustomerController');


	// });
    
 
	
	

