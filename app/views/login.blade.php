<!-- app/views/caes/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Electrician</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">順光</a>
        </div>
    </div>
</div>
<div class="container">
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
	{{ Form::open(array('url' => 'login')) }}
		<h1>登入</h1>

		<!-- if there are login errors, show them here -->
		{{ HTML::ul($errors->all()) }}

		<div class="form-group">
			{{ Form::label('email', '帳號') }}
			{{ Form::text('email', Input::old('email'), array('placeholder' => 'user@example.com','class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('password', '密碼') }}
			{{ Form::password('password', array('class' => 'form-control')) }}
		</div>

		<p>{{ Form::submit('登入', array('class' => 'btn btn-primary')) }}</p>
	{{ Form::close() }}
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>