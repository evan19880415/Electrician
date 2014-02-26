@extends('layouts.master')
@section('content')

<h1>新增客戶</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'customers')) }}

	<div class="form-group">
		{{ Form::label('name', '姓名') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
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
		{{ Form::hidden('level', Input::old('level'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('新增', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop