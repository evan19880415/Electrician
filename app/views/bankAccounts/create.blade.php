@extends('layouts.master')
@section('content')

<h1>新增帳戶</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'bankAccount/store')) }}

	<div class="form-group">
		{{ Form::label('name', '銀行名稱') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('account_number', '帳戶號碼') }}
		{{ Form::text('account_number', Input::old('account'), array('class' => 'form-control')) }}
	</div>


	{{ Form::submit('新增', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop