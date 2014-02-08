<!-- app/views/cases/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Electrician</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<div class="container">

<script>
	(function ($, window, delay) {
	  // http://jsfiddle.net/AndreasPizsa/NzvKC/
	  var theTimer = 0;
	  var theElement = null;
	  var theLastPosition = {x:0,y:0};
	  $('[data-toggle]')
	    .closest('li')
	    .on('mouseenter', function (inEvent) {
	    if (theElement) theElement.removeClass('open');
	    window.clearTimeout(theTimer);
	    theElement = $(this);

	    theTimer = window.setTimeout(function () {
	      theElement.addClass('open');
	    }, delay);
	  })
	    .on('mousemove', function (inEvent) {
	        if(Math.abs(theLastPosition.x - inEvent.ScreenX) > 4 || 
	           Math.abs(theLastPosition.y - inEvent.ScreenY) > 4)
	        {
	            theLastPosition.x = inEvent.ScreenX;
	            theLastPosition.y = inEvent.ScreenY;
	            return;
	        }
	        
	    if (theElement.hasClass('open')) return;
	    window.clearTimeout(theTimer);
	    theTimer = window.setTimeout(function () {
	      theElement.addClass('open');
	    }, delay);
	  })
	    .on('mouseleave', function (inEvent) {
	    window.clearTimeout(theTimer);
	    theElement = $(this);
	    theTimer = window.setTimeout(function () {
	      theElement.removeClass('open');
	    }, delay);
	  });
	})(jQuery, window, 200); // 200 is the delay in milliseconds
</script>
<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('cases') }}">HOME</a>
	</div>
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
</nav>


<h1>Create a Case</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'cases')) }}

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

	{{ Form::submit('Create the Case!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
<script type="text/javascript">
(function(e,d,b){var a=0;var f=null;var c={x:0,y:0};e("[data-toggle]").closest("li").on("mouseenter",function(g){if(f){f.removeClass("open")}d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mousemove",function(g){if(Math.abs(c.x-g.ScreenX)>4||Math.abs(c.y-g.ScreenY)>4){c.x=g.ScreenX;c.y=g.ScreenY;return}if(f.hasClass("open")){return}d.clearTimeout(a);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mouseleave",function(g){d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.removeClass("open")},b)})})(jQuery,window,200);
</script>
</body>
</html>