<!-- app/views/nerds/edit.blade.php -->
<!-- app/views/nerds/edit.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('cases') }}">HOME</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('cases') }}">View All Cases</a></li>
		<li><a href="{{ URL::to('cases/create') }}">Create a Case</a>
	</ul>
</nav>

<h1>Edit {{ $case->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($case, array('route' => array('cases.update', $case->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('typeId', 'Type') }}
		{{ Form::select('typeId', array('0' => 'Select Type', '1' => 'Water', '2' => 'Electronic'), Input::old('typeId'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('address', 'Address') }}
		{{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('phone', 'Phone') }}
		{{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('mobile', 'Mobile') }}
		{{ Form::text('mobile', Input::old('mobile'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('money', 'Money') }}
		{{ Form::text('money', Input::old('money'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Edit the Case!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>