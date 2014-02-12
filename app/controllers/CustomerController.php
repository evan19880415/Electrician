<?php

class CustomerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the customer
		$customers = Customer::paginate(10);
		Session::flash('customerTitle', '客戶資料');
		// load the view and pass the customers
		return View::make('customers.index')
			->with('customers', $customers);
	}

	public function customerSearch($text)
	{
		// get all the customer
		$customers = Customer::where('name', 'like','%'.$text.'%')->orWhere('phone', 'like','%'.$text.'%')->orWhere('mobile', 'like','%'.$text.'%')->paginate(10);

		Session::flash('customerTitle', '查詢結果');
		// load the view and pass the customer
		return View::make('customers.index')
			->with('customers', $customers);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/customers/create.blade.php)
		return View::make('customers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'name'       => 'required',
			'phone'      => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('customers/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$customers = new Customer;
			$customers->name        = Input::get('name');
			$customers->address 	= Input::get('address');
			$customers->phone 		= Input::get('phone');
			$customers->mobile 		= Input::get('mobile');

			$customers->save();

			// redirect
			Session::flash('message', '新增成功!');
			return Redirect::to('customers');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the customers
		$customer = Customer::find($id);

		// show the view and pass the customer to it
		return View::make('customers.show')
			->with('customer', $customer);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the customer
		$customer = Customer::find($id);

		// show the edit form and pass the customer
		return View::make('customers.edit')
			->with('customer', $customer);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'name'       => 'required',
			'phone'      => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('customers/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$customers = Customer::find($id);
			$customers->name        = Input::get('name');
			$customers->address 	= Input::get('address');
			$customers->phone 		= Input::get('phone');
			$customers->mobile 		= Input::get('mobile');

			$customers->save();

			// redirect
			Session::flash('message', '編輯成功!');
			return Redirect::to('customers');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$customer = Customer::find($id);
		$customer->delete();

		// redirect
		Session::flash('message', '刪除成功!');
		return 'success';
	}

}