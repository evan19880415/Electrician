<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', function()
{
	return Redirect::to('login');
});

Route::filter('admin_auth', function()
{
    if(Auth::guest() || Auth::user()=='') {
        return Redirect::to('login');
    }
});

Route::group(array('before' => 'admin_auth'), function()
{
	//Caes
	Route::resource('cases', 'CaseController');
	Route::post('finishedCase/{id}','CaseController@finishedCase');

	Route::get('commonCase','CaseController@commonCase');
	Route::get('electronicCase','CaseController@electronicCase');

	Route::get('completedCase','CaseController@completedCase');
	Route::get('commonCase/completedCase','CaseController@commonCompletedCase');
	Route::get('electronicCase/completedCase','CaseController@electronicCompletedCase');

	Route::get('unfinishedCase','CaseController@unfinishedCase');
	Route::get('commonCase/unfinishedCase','CaseController@commonUnfinishedCase');
	Route::get('electronicCase/unfinishedCase','CaseController@electronicUnfinishedCase');

	Route::get('dateSearchCase/{startDate}/{endDate}','CaseController@dateSearchCase');
	Route::get('commonCase/dateSearchCase/{startDate}/{endDate}','CaseController@commonDateSearchCase');
	Route::get('electronicCase/dateSearchCase/{startDate}/{endDate}','CaseController@electronicDateSearchCase');

	//transfer case to customer
	Route::post('transferToCustomer/{id}','CaseController@transferToCustomer');

	Route::get('casesSearch', function(){return View::make('cases.search');});

	//Customer
	Route::resource('customers', 'CustomerController');
	Route::get('customerSearch/{text}','CustomerController@customerSearch');

	//accounting
	Route::resource('accounting', 'AccountingController');

	//bank
	Route::controller('bankAccount', 'bankAccountController');

});	

// route to show the login formcases
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('logout', array('uses' => 'HomeController@doLogout'));
