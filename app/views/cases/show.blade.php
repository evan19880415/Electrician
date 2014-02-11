<!-- app/views/cases/show.blade.php -->

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


<h1>事項資料</h1>

	<div class="jumbotron">
		<h2>{{ $case->name }}</h2>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td><strong>工作內容</strong></td>
					<td>{{ $case->description }}</td>
				</tr>
				<tr class="success">
					<td><strong>類型</strong></td>
					<td>{{ $caseType }}</td>
				</tr>
				<tr>
					<td><strong>住址</strong></td>
					<td>{{ $case->address }}</td>
				</tr>
				<tr class="success">
					<td><strong>電話</strong> </td>
					<td>{{ $case->phone }}</td>
				</tr>
				<tr>
					<td><strong>手機</strong></td>
					<td>{{ $case->mobile }}</td>
				</tr>
				<tr>
					<td><strong>發票號碼</strong></td>
					<td>{{ $case->invoice }}</td>
				</tr>
				<tr class="success">
					<td><strong>金額</strong></td>
					<td>{{ $case->money }}</td>
				</tr>
				<tr>
					<td><strong>狀態</strong></td>
					<td>{{ $caseLevel }}</td>
				</tr>				
			</tbody>
		</table>
	</div>

</div>

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>