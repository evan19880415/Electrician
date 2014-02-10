<!-- app/views/cases/search.blade.php -->

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

<script>
	$(function(){
	    $("#search").click(function(){
	        var startDate = $('#startDate').val();
			var endDate = $('#endDate').val();
			var type = $('#typeId').val();

			if(type == "All"){
				var requestPath = "{{ URL::to('dateSearchCase') }}/"+startDate+"/"+endDate;
			}else if(type == "Common"){
				var requestPath = "{{ URL::to('commonCase/dateSearchCase') }}/"+startDate+"/"+endDate;
			}
			else{
				var requestPath = "{{ URL::to('electronicCase/dateSearchCase') }}/"+startDate+"/"+endDate;
			}

			window.location.href = requestPath;
	    });

	    $('#startDate').datepicker({
		    format: "yyyy-mm-dd",
    		autoclose: true,
    		language: 'zh-TW'
		});
		$("#startDate").datepicker("setDate", new Date());
		$("#startDate").datepicker('update');

	    $('#endDate').datepicker({
		    format: "yyyy-mm-dd",
    		autoclose: true,
    		language: 'zh-TW'
		});
	});
</script>
<h1>Search</h1>

	<div class="form-group">
		<label>Start Date</label>
		<input class="form-control" name="startDate" type="text" id="startDate">
	</div>

	<div class="form-group">
		<label>End Date</label>
		<input class="form-control" name="endDate" type="text" id="endDate" value="-">
	</div>

	<div class="form-group">
		<label>Type</label>
		<select class="form-control" id="typeId" name="typeId">
			<option value="All">All</option>
			<option value="Common">Common</option>
			<option value="Electronic">Electronic</option>
		</select>
	</div>

	<input class="btn btn-primary" type="button" value="Search" id="search">

</div>

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/locales/bootstrap-datepicker.zh-TW.js"></script>
</body>
</html>