<!-- app/views/nerds/show.blade.php -->

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


<h1>Showing {{ $case->name }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $case->name }}</h2>
		<p>
			<strong>Description:</strong> {{ $case->description }}<br>
			<strong>Type:</strong> {{ $case->typeId }}<br>
			<strong>Address:</strong> {{ $case->address }}<br>
			<strong>Phone:</strong> {{ $case->phone }}<br>
			<strong>Mobile:</strong> {{ $case->mobile }}<br>
			<strong>Money:</strong> {{ $case->money }}<br>
			<strong>Level:</strong> {{ $case->level }}
		</p>
	</div>

</div>
</body>
</html>