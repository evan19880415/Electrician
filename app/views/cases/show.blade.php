<!-- app/views/nerds/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Electrician</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Home</a>
        </div>
        <div class="collapse navbar-collapse">
          	<ul class="nav navbar-nav">
				<li class="dropdown-toggle"><a href="{{ URL::to('cases') }}" class="dropdown-toggle" data-toggle="dropdown">All Cases</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('commonCase') }}">Common Cases</a></li>
						<li><a tabindex="-1" href="{{ URL::to('electronicCase') }}">Electronic Cases</a></li>
					</ul>
				</li>		
				<li class="dropdown-toggle"><a href="{{ URL::to('completedCase') }}" class="dropdown-toggle" data-toggle="dropdown">Completed Cases</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('commonCase/completedCase') }}">Common Cases</a></li>
						<li><a tabindex="-1" href="{{ URL::to('electronicCase/completedCase') }}">Electronic Cases</a></li>
					</ul>
				</li>
				<li class="dropdown-toggle"><a href="{{ URL::to('unfinishedCase') }}" class="dropdown-toggle" data-toggle="dropdown">Unfinished Cases</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('commonCase/unfinishedCase') }}">Common Cases</a></li>
						<li><a tabindex="-1" href="{{ URL::to('electronicCase/unfinishedCase') }}">Electronic Cases</a></li>
					</ul>
				</li>
				<li><a href="{{ URL::to('cases/create') }}">Create a Case</a></li>
				<li><a href="{{ URL::to('casesSearch') }}">Search</a></li>
			</ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container">


<h1>Information</h1>

	<div class="jumbotron">
		<h2>{{ $case->name }}</h2>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td><strong>Description</strong></td>
					<td>{{ $case->description }}</td>
				</tr>
				<tr class="success">
					<td><strong>Type</strong></td>
					<td>{{ $case->typeId }}</td>
				</tr>
				<tr>
					<td><strong>Address</strong></td>
					<td>{{ $case->address }}</td>
				</tr>
				<tr class="success">
					<td><strong>Phone</strong> </td>
					<td>{{ $case->phone }}</td>
				</tr>
				<tr>
					<td><strong>Mobile</strong></td>
					<td>{{ $case->mobile }}</td>
				</tr>
				<tr class="success">
					<td><strong>Money</strong></td>
					<td>{{ $case->money }}</td>
				</tr>
				<tr>
					<td><strong>Level</strong></td>
					<td>{{ $case->level }}</td>
				</tr>				
			</tbody>
		</table>
	</div>

</div>

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>