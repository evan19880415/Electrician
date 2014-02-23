<?php

class BankAccountController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function getCreate()
    {
        //
        return View::make('bankAccounts.create');
    }

	public function postStore()
    {
    	$bankAccount = new BankAccount;
		$bankAccount->name        	= Input::get('name');
		$bankAccount->account_number 	= Input::get('account_number');

		$bankAccount->save();

		// redirect
		Session::flash('message', '新增帳戶成功!');
		return Redirect::to('cases');    //
    }

}