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
		$cases = Caseinfo::paginate(10);
		Session::flash('caseTitle', '所有事項');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}


	public function commonCase()
	{
		// get all the CommonCase
		$cases = Caseinfo::where('typeId', '==',0)->paginate(10);
		Session::flash('caseTitle', '一般事項');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function electronicCase()
	{
		// get all the ElectronicCase
		$cases = Caseinfo::where('typeId', '<>',0)->paginate(10);
		Session::flash('caseTitle', '請水電事項');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function completedCase()
	{
		// get all the CompletedCase
		$cases = Caseinfo::where('level', '<>',0)->paginate(10);
		Session::flash('caseTitle', '完工事項');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function commonCompletedCase()
	{
		// get all the commonCompletedCase
		$cases = Caseinfo::where('typeId', '==',0)->where('level', '<>',0)->paginate(10);
		Session::flash('caseTitle', '完工事項(一般)');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function electronicCompletedCase()
	{
		// get all the electronicCompletedCase
		$cases = Caseinfo::where('typeId', '<>',0)->where('level', '<>',0)->paginate(10);
		Session::flash('caseTitle', '完工事項(請水電)');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}
	
	public function unfinishedCase()
	{
		// get all the unfinishedCase
		$cases = Caseinfo::where('created_at', '<>',1)->paginate(10);
		Session::flash('caseTitle', '未完工事項');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function commonUnfinishedCase()
	{
		// get all the commonUnfinishedCase
		$cases = Caseinfo::where('typeId', '==',0)->where('level', '<>',1)->paginate(10);
		Session::flash('caseTitle', '未完工事項(一般)');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function electronicUnfinishedCase()
	{
		// get all the electronicUnfinishedCase
		$cases = Caseinfo::where('typeId', '<>',0)->where('level', '<>',1)->paginate(10);
		Session::flash('caseTitle', '未完工事項(請水電)');
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function dateSearchCase($startDate,$endDate)
	{
		// get all the dateSearchCase
		if($endDate=='-'){
			$start = new Date($startDate);
			$cases = Caseinfo::where('created_at', '>', $startDate)->where('created_at', '<', $start->add('1 day'))->paginate(10);
			Session::flash('caseTitle', $startDate);
		}else{
			$end = new Date($endDate);
			$cases = Caseinfo::where('created_at', '>', $startDate)->where('created_at', '<', $end->add('1 day'))->paginate(10);
			Session::flash('caseTitle', $startDate.'~'.$endDate);
		}
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function commonDateSearchCase($startDate,$endDate)
	{
		// get all the dateSearchCase
		if($endDate=='-'){
			$start = new Date($startDate);
			$cases = Caseinfo::where('created_at', '>', $startDate)->where('created_at', '<', $start->add('1 day'))->where('typeId', '==',0)->paginate(10);
			Session::flash('caseTitle', $startDate);
		}else{
			$end = new Date($endDate);
			$cases = Caseinfo::where('created_at', '>', $startDate)->where('created_at', '<', $end->add('1 day'))->where('typeId', '==',0)->paginate(10);
			Session::flash('caseTitle', $startDate.'~'.$endDate);
		}
		// load the view and pass the cases
		return View::make('cases.index')
			->with('cases', $cases);
	}

	public function electronicDateSearchCase($startDate,$endDate)
	{
		// get all the dateSearchCase
		if($endDate=='-'){
			$start = new Date($startDate);
			$cases = Caseinfo::where('created_at', '>', $startDate)->where('created_at', '<', $start->add('1 day'))->where('typeId', '<>',0)->paginate(10);
			Session::flash('caseTitle', $startDate);
		}else{
			$end = new Date($endDate);
			$cases = Caseinfo::where('created_at', '>', $startDate)->where('created_at', '<', $end->add('1 day'))->where('typeId', '<>',0)->paginate(10);
			Session::flash('caseTitle', $startDate.'~'.$endDate);
		}
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
			$case->invoice 		= Input::get('invoice');
			$case->typeId 		= Input::get('typeId');
			$case->level       	= Input::get('level');
			$case->save();

			// redirect
			Session::flash('message', '新增成功!');
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
		//$case = CaseInfo::find($id);

		$case = Caseinfo::find($id);

		switch ($case->typeId) {
		   case 0:
		         $caseType = '一般事項';
		         break;
		   case 1:
		         $caseType = '水';
		         break;
		   case 2:
		         $caseType = '電(新設)';
		         break;
		   case 3:
		         $caseType = '電(增設)';
		         break;
		   case 4:
		         $caseType = '電(分戶)';
		         break;
		   case 5:
		         $caseType = '電(噴霧)';
		         break;                  
		}

		
		switch ($case->level) {
			case 0:
			    $caseLevel = '未完工';
			    break;
			case 1:
			    $caseLevel = '已完工';
			    break;
  			case 2:
			    $caseLevel = '已收款';
			    break;
		}
		
		

		// show the view and pass the case to it
		return View::make('cases.show')
			->with('case', $case)
			->with('caseType', $caseType)
			->with('caseLevel', $caseLevel);
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
		return $case;
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
			Session::flash('message', '編輯失敗! 請確認姓名和電話都有填寫');
			return 'error';
		} else {
			// store
			$case = Caseinfo::find($id);
			$case->name        	= Input::get('name');
			$case->description 	= Input::get('description');
			$case->address 		= Input::get('address');
			$case->phone 		= Input::get('phone');
			$case->mobile 		= Input::get('mobile');
			$case->money 		= Input::get('money');
			$case->invoice 		= Input::get('invoice');
			$case->typeId 		= Input::get('typeId');
			if($case->money == 0){
				$case->level       	= Input::get('level');
			}else{
				$case->level       	= 2;
			}
			$case->save();

			// redirect
			Session::flash('message', '編輯成功!');
			return 'success';
		}
	}

	public function finishedCase($id)
	{
		// get the case
		$case = Caseinfo::find($id);
		$case->level = 1;
		$case->save();

		Session::flash('message', $case->name.'完工!');
		// show the edit form and pass the nerd
		return "Finished Case Success";
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
		Session::flash('message', '刪除成功!');
		return 'success';
	}

}