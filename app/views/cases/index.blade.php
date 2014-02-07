<!-- app/views/caes/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Electrician</title>
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

<h1>All the Cases</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Type</td>
			<td>Description</td>
			<td>Address</td>
			<td>Phone</td>
			<td>Mobile</td>
			<td>Money</td>
			<td>Level</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($cases as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->typeId }}</td>
			<td>{{ $value->description}}</td>
			<td>{{ $value->address}}</td>
			<td>{{ $value->phone}}</td>
			<td>{{ $value->mobile}}</td>
			<td>{{ $value->money}}</td>
			<td>{{ $value->level}}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the case (uses the destroy method DESTROY /cases/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				{{ Form::open(array('url' => 'cases/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this Case', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
				
				<!-- show the case (uses the show method found at GET /cases/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('cases/' . $value->id) }}">Show this Case</a>

				<!-- edit this case (uses the edit method found at GET /cases/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('cases/' . $value->id . '/edit') }}">Edit this Case</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>