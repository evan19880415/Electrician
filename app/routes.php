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

Route::filter('auth', function()
{
    if(Auth::guest() || Auth::user()=='') {
        return Redirect::to('login');
    }
});

Route::filter('admin', function()
{
    if(Auth::guest() || Auth::user()=='') {
        return Redirect::to('login');
    }else{   	
	    if(Auth::user()->groupId <> 1) {
	        return Response::view('errors.403', array(), 403);
	    }
    }
});

Route::group(array('before' => 'auth'), function()
{
	//Caes
	Route::resource('cases', 'CaseController');

	//provide paid case
	Route::get('electronicPaidCase', 'CaseController@electronicPaidCase');
	
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

});	

Route::group(array('before' => 'admin'), function()
{
	//accounting
	Route::resource('accountings', 'AccountingController');
	Route::get('indexYear','AccountingController@indexYear');
	Route::get('revenueYearReport/{year}','AccountingController@revenueYearReport');
	Route::get('revenueMonthReport/{year}/{month}','AccountingController@revenueMonthReport');

	//bank
	Route::controller('bankAccount', 'BankAccountController');
	Route::controller('bankCheck', 'BankCheckController');
});

// route to show the login formcases
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('logout', array('uses' => 'HomeController@doLogout'));
