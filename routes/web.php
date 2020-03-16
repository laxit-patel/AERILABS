<?php

//remnent of a great occurence
//.env file is not visible somehow
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {


	Route::get('/reports', function () {
		return view('report');
	});

	//curd routes
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::resource('client', 'ClientController', ['except' => ['show']]);
	Route::resource('material', 'MaterialController', ['except' => ['show']]);
	Route::resource('test', 'TestController', ['except' => ['show']]);
	Route::resource('inward', 'InwardController', ['except' => ['show']]);
    Route::resource('invoice', 'InvoiceController', ['except' => ['show']]);
    Route::resource('payment', 'InvoiceController', ['except' => ['show']]);

	//dynamic routes
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	//Lab routes
	Route::get('/lab', 'LabController@index')->name('lab');
	//Route::get('/perform/{inward_id}', 'LabController@perform')->name('perform');
	Route::get('/perform/{record_id}', 'LabController@perform')->name('perform');
    
	//add test or quotation into inward route
	Route::get('/inwardAddTest', 'InwardController@addTest');

	//downlaoding test worksheet using routes
	Route::get('/download',function(){
		$path = request()->path;
        $chunks = explode("\\",$path);
        $filename = end($chunks);
        $realpath = realpath($path);
		return Response::download($realpath);
	});

	//ajax routes
	Route::get('/getMaterials/{id}', 'MaterialController@ajax');
	Route::get('/getTest/{id}', 'TestController@ajax');
	//Route::get('/updateInwardPhase', 'InwardController@phase');
	Route::get('/updateRecordPhase', 'InwardController@phase');
	Route::get('/getTestForInward/{id}', 'InwardController@sendTest');
    Route::get('/getRecordsForInward/{inward}', 'RecordsController@sendRecordsForInvoice');
	//Route::get('/updateTestPhase', 'TestController@phase');
    Route::get('/getInwardsForClient/{client_id}','InvoiceController@getInwardsForClient');
    Route::get('/getBaseRates','TestController@getBaseRates');

	//assign inward to user
	//Route::get('assignInward/{inward}/to/{user}','InwardController@assignInward');

	//assign record to user
	Route::get('assignRecord/{record}/to/{user}','InwardController@assignRecord');

	//test completed
	Route::post('completed/{inward_id}/{record_id}', 'InwardController@status');

	//inward edit
	Route::get('/edit/{inward_id}', 'InwardController@edit');
	Route::post('/addNewRecord', 'InwardController@addNewRecord')->name('addNewRecord');

	//accounting Routes
    Route::get('/ledger', 'LedgerController@index')->name('ledger');
    Route::get('/invoice/view/{invoice_id}', 'InvoiceController@view')->name('ViewInvoice');
    Route::get('/invoice/pay/{invoice_id}', 'InvoiceController@pay')->name('pay');
    Route::get('/rates', 'RatesController@index')->name('rates');
    Route::post('/rates/add', 'RatesController@store')->name('ratesStore');
    Route::get('/rates/ratesUpdate', 'RatesController@updateRates')->name('ratesUpdate');
    Route::get('/getRatesForClient','RatesController@getRatesForClient');


    //payment Routes
    Route::post('/payment', 'PaymentController@ProcessPayment')->name('ProcessPayment');

    //inward archive
    Route::get('/inward/archive', 'InwardController@archive')->name('archive');

    //quotation Routes
    Route::get('/quotation', 'QuotationController@index')->name('quotation');
    Route::get('/quotation/create', 'QuotationController@create')->name('createQuotation');
    Route::post('/quotation/create/draft', 'QuotationController@processDraft')->name('processDraft');
    Route::get('/quotation/create/generate', 'QuotationController@generate')->name('generateQuotation');

});

