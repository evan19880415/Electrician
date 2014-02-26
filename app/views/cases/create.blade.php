@extends('layouts.master')
@section('content')

<h1>新增事項</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'cases')) }}

	<div class="form-group">
		{{ Form::label('name', '姓名') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('typeId', '類型') }}
		{{ Form::select('typeId', array('0' => '預設事項', '1' => '水', '2' => '電(新設)', '3' => '電(增設)', '4' => '電(分戶)', '5' => '電(噴霧)'), Input::old('typeId'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', '工作內容') }}
		{{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('address', '住址') }}
		{{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('phone', '電話') }}
		{{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('mobile', '手機') }}
		{{ Form::text('mobile', Input::old('mobile'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('invoice', '發票號碼') }}
		{{ Form::text('invoice', Input::old('invoice'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('money', '金額') }}
		{{ Form::text('money', Input::old('money'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::hidden('level', Input::old('level'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('新增', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop