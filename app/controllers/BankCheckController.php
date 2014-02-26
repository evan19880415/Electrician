<?php

class BankCheckController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
	    //
	    $bankCheck = BankCheck::all();

	    return $bankCheck;

	}
	public function getIndexByid($id)
	{
	    //
	    $bankCheck = BankCheck::find($id);

	    return $bankCheck;

	}

	public function putUpdateByid($id)
	{
	    		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'created_date'       => 'required',
			'check_number'      => 'required|size:9',
			'expired_date' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			Session::flash('message', '編輯失敗! 請確認資訊正確填寫');
			return 'error';
		} else {
			// store
			$bankCheck = BankCheck::find($id);
			$bankCheck->created_date    = Input::get('created_date');
			$bankCheck->check_number 	= Input::get('check_number');
			$bankCheck->expired_date 	= Input::get('expired_date');
			$bankCheck->notes 			= Input::get('notes');

			$bankCheck->save();

			// redirect
			Session::flash('message', '編輯成功!');
			return 'success';
		}
	}

}