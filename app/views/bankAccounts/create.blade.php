<!-- app/views/cases/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Electrician</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
          <a class="navbar-brand" href="{{ URL::to('cases') }}">順光</a>
        </div>
        <div class="collapse navbar-collapse">
          	<ul class="nav navbar-nav">
				<li class="dropdown-toggle"><a href="{{ URL::to('cases') }}" class="dropdown-toggle" data-toggle="dropdown">事項</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('commonCase') }}">一般事項</a></li>
						<li><a tabindex="-1" href="{{ URL::to('electronicCase') }}">請水電事項</a></li>
					</ul>
				</li>		
				<li class="dropdown-toggle"><a href="{{ URL::to('completedCase') }}" class="dropdown-toggle" data-toggle="dropdown">完工事項</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('commonCase/completedCase') }}">一般事項</a></li>
						<li><a tabindex="-1" href="{{ URL::to('electronicCase/completedCase') }}">請水電事項</a></li>
					</ul>
				</li>
				<li class="dropdown-toggle"><a href="{{ URL::to('unfinishedCase') }}" class="dropdown-toggle" data-toggle="dropdown">未完工事項</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('commonCase/unfinishedCase') }}">一般事項</a></li>
						<li><a tabindex="-1" href="{{ URL::to('electronicCase/unfinishedCase') }}">請水電事項</a></li>
					</ul>
				</li>
				<li class="dropdown-toggle"><a href="#" class="dropdown-toggle" data-toggle="dropdown">事項功能</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('cases/create') }}">新增事項</a></li>
						<li><a tabindex="-1" href="{{ URL::to('casesSearch') }}">日期查詢</a></li>
					</ul>
				</li>
				<li class="dropdown-toggle"><a href="#" class="dropdown-toggle" data-toggle="dropdown">客戶相關</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('customers') }}">客戶資料</a></li>
						<li><a tabindex="-1" href="{{ URL::to('customers/create') }}">新增客戶</a></li>
					</ul>
				</li>
				<li><a href="{{ URL::to('logout') }}">登出</a></li>
			</ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container">

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

</div>
<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>