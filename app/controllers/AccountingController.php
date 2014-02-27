<?php

class AccountingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$date = new Date('today');
		$nextDate = new Date('next month');
		$year = $date->getYear();
		$month = $date->getMonth();
		$nextMonth = $nextDate->getMonth();
		$current_month = new Date($year.'-'.$month.'-01');
		$next_month = new Date($year.'-'.$nextMonth.'-01');

		$accountings = Accounting::where('created_date', '>', $current_month)->where('created_date', '<', $next_month)->orderBy('created_date', 'ASC')->get();
		$income = Accounting::where('created_date', '>', $current_month)->where('created_date', '<', $next_month)->where('type', '=', '0')->sum('money');
		$outcome = Accounting::where('created_date', '>', $current_month)->where('created_date', '<', $next_month)->where('type', '=', '1')->sum('money');
		$revenue = $income-$outcome;

		return View::make('accountings.index')
				->with('accountings',$accountings)
				->with('income',$income)
				->with('outcome',$outcome)
				->with('revenue',$revenue)
				->with('year',$year)
				->with('month',$month);
	}

	public function indexYear()
	{
		$date = new Date('today');
		$year = $date->getYear();
		return Redirect::to('revenueYearReport/'.$year);
	}

	protected function revenueMonthReport($year,$month){
		$currentDate = new Date($year.'-'.$month.'-01');

		$year = $currentDate->getYear();
		$month = $currentDate->getMonth();
		$nextMonth = (int)$month+1;

		$current_month = new Date($year.'-'.$month.'-01');
		$next_month = new Date($year.'-'.(string)$nextMonth.'-01');

		$accountings = Accounting::where('created_date', '>', $current_month)->where('created_date', '<', $next_month)->orderBy('created_date', 'ASC')->get();
		$income = Accounting::where('created_date', '>', $current_month)->where('created_date', '<', $next_month)->where('type', '=', '0')->sum('money');
		$outcome = Accounting::where('created_date', '>', $current_month)->where('created_date', '<', $next_month)->where('type', '=', '1')->sum('money');
		if($income == null){
			$income = 0;
		}
		if($outcome == null){
			$outcome = 0;
		}
		$revenue = $income-$outcome;

		return View::make('accountings.index')
				->with('accountings',$accountings)
				->with('income',$income)
				->with('outcome',$outcome)
				->with('revenue',$revenue)
				->with('year',$year)
				->with('month',$month);
	}

	protected function revenueYearReport($year){
		$currentDate = new Date($year.'-01'.'-01');

		$year = $currentDate->getYear();
		$nextYear = (int)$year+1;

		$current_year = new Date($year.'-01'.'-01');
		$next_year = new Date((string)$nextYear.'-01'.'-01');

		$monthInfo = array();

		//$i = month
		for($i=1;$i<=12;$i++){
			$month = new Date($year.'-'.$i.'-01');
			$nextMonth = (int)$i+1;

			//handle December
			if($nextMonth == 13){
				$monthInfo[$i]['income'] = Accounting::where('created_date', '>', $month)->where('created_date', '<', $next_year)->where('type', '=', '0')->sum('money');
				$monthInfo[$i]['outcome'] = Accounting::where('created_date', '>', $month)->where('created_date', '<', $next_year)->where('type', '=', '1')->sum('money');
			}else{
				$next_month = new Date($year.'-'.(string)$nextMonth.'-01');
				$monthInfo[$i]['income'] = Accounting::where('created_date', '>', $month)->where('created_date', '<', $next_month)->where('type', '=', '0')->sum('money');
				$monthInfo[$i]['outcome'] = Accounting::where('created_date', '>', $month)->where('created_date', '<', $next_month)->where('type', '=', '1')->sum('money');
			}

			if($monthInfo[$i]['income'] == null){
				$monthInfo[$i]['income'] = 0;
			}
			if($monthInfo[$i]['outcome'] == null){
				$monthInfo[$i]['outcome'] = 0;
			}
		}
		$accountings = Accounting::where('created_date', '>', $current_year)->where('created_date', '<', $next_year)->orderBy('created_date', 'ASC')->get();
		$income = Accounting::where('created_date', '>', $current_year)->where('created_date', '<', $next_year)->where('type', '=', '0')->sum('money');
		$outcome = Accounting::where('created_date', '>', $current_year)->where('created_date', '<', $next_year)->where('type', '=', '1')->sum('money');
		$maxMoney = Accounting::where('created_date', '>', $current_year)->where('created_date', '<', $next_year)->max('money');
		
		if($income == null){
			$income = 0;
		}
		if($outcome == null){
			$outcome = 0;
		}
		$revenue = $income-$outcome;

		return View::make('accountings.yearReport')
			->with('accountings',$accountings)
			->with('monthInfo',$monthInfo)
			->with('income',$income)
			->with('outcome',$outcome)
			->with('revenue',$revenue)
			->with('maxMoney',$maxMoney)
			->with('year',$year);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return View::make('accountings.create');
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
			'type'       => 'required',
			'money_id'       => 'required',
			'check_number'       => 'size:9',
			'money'       => 'required',
			'startDate'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('accountings/create')
				->withErrors($validator);
		} else {
				// store
				$accounting = new Accounting;
				$accounting->name       = Input::get('name');
				$accounting->type 		= Input::get('type');
				$accounting->money_id = Input::get('money_id');
				switch (Input::get('money_id')) {
				   case 1:
				        $accounting->money_ref = Input::get('account_number');
				        break;
				   case 2:
				        $bank_check = new BankCheck;
				        $bank_check->notes = Input::get('check_notes');
				        $bank_check->check_number = Input::get('check_number');
				        $bank_check->created_date = date("Y-m-d", strtotime(Input::get('created_at')));
				        $bank_check->expired_date = date("Y-m-d", strtotime(Input::get('expired_at')));
				        $bank_check->save();
				        
				        $accounting->money_ref = $bank_check->id;
				        break;                 
				}
				$accounting->created_date = date("Y-m-d", strtotime(Input::get('startDate')));
				$accounting->money = Input::get('money');
				$accounting->save();

				$case = Caseinfo::where('name','=',Input::get('name')); 
				if($case->get() <> null){
					$case->update(array('level' => 3));
				}
			

			// redirect
			Session::flash('message', '新增帳款成功!');
			return Redirect::to('accountings');
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
		$accounting = Accounting::find($id);
		if($accounting->money_id <> 2){
			$accounting->delete();
		}else{
			$bankCheck = BankCheck::find($accounting->money_ref);
			$bankCheck->delete();
			$accounting->delete();
		}
		
		
		// redirect
		Session::flash('message', '刪除帳款成功!');
		return 'success';
	}

}