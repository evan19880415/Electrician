<?php

class CaseController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the case
		$cases = Caseinfo::all();

		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/cases/create.blade.php)
		return View::make('cases.create');
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
			'phone'      => 'required',
			'typeId' => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('cases/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$case = new Caseinfo;
			$case->name        	= Input::get('name');
			$case->description 	= Input::get('description');
			$case->address 		= Input::get('address');
			$case->phone 		= Input::get('phone');
			$case->mobile 		= Input::get('mobile');
			$case->money 		= Input::get('money');
			$case->typeId 		= Input::get('typeId');
			$case->level       	= Input::get('level');
			$case->save();

			// redirect
			Session::flash('message', 'Successfully created case!');
			return Redirect::to('cases');
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
		// get the case
		$case = CaseInfo::find($id);

		// show the view and pass the case to it
		return View::make('cases.show')
			->with('case', $case);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the case
		$case = Caseinfo::find($id);

		// show the edit form and pass the nerd
		return View::make('cases.edit')
			->with('case', $case);
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
			'phone'      => 'required',
			'typeId' => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('cases/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$case = Caseinfo::find($id);
			$case->name        	= Input::get('name');
			$case->description 	= Input::get('description');
			$case->address 		= Input::get('address');
			$case->phone 		= Input::get('phone');
			$case->mobile 		= Input::get('mobile');
			$case->money 		= Input::get('money');
			$case->typeId 		= Input::get('typeId');
			$case->level       	= Input::get('level');
			$case->save();

			// redirect
			Session::flash('message', 'Successfully updated case!');
			return Redirect::to('cases');
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
		$case = Caseinfo::find($id);
		$case->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the case!');
		return Redirect::to('cases');
	}

}