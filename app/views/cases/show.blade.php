<!-- app/views/nerds/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Electrician</title>
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
<script type="text/javascript">
(function(e,d,b){var a=0;var f=null;var c={x:0,y:0};e("[data-toggle]").closest("li").on("mouseenter",function(g){if(f){f.removeClass("open")}d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mousemove",function(g){if(Math.abs(c.x-g.ScreenX)>4||Math.abs(c.y-g.ScreenY)>4){c.x=g.ScreenX;c.y=g.ScreenY;return}if(f.hasClass("open")){return}d.clearTimeout(a);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mouseleave",function(g){d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.removeClass("open")},b)})})(jQuery,window,200);
</script>
</body>
</html>