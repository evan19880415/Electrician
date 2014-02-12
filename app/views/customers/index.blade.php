<!-- app/views/customers/index.blade.php -->

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

@if (Session::has('customerTitle'))
	<h1>{{ Session::get('customerTitle') }}</h1>
@endif

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
	<div class="input-group">
		<input class="form-control" name="search" type="text" id="searchText" placeholder="輸入想搜尋的姓名或電話">
		<div class="input-group-btn">
            <button class="btn btn-default" type="submit" id="searchButton"><i class="glyphicon glyphicon-search"></i></button>
        </div>
	</div>
	</br>
	<div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<td>姓名</td>
					<td>電話</td>
					<td>功能</td>
				</tr>
			</thead>
			<tbody>
			@foreach($customers as $key => $value)
				<tr>
					<td>{{ $value->name }}</td>
					<td>{{ $value->phone }}</td>
					<!-- we will also add show, edit, and delete buttons -->
					<td>
						<!-- show the customers (uses the show method found at GET /cases/{id} -->
						<a class="btn btn-xs btn-success" href="{{ URL::to('customers/' . $value->id) }}">資料</a>

						<!-- edit this customers (uses the edit method found at GET /cases/{id}/edit -->
						<a class="btn btn-xs btn-info" href="{{ URL::to('customers/' . $value->id . '/edit') }}">編輯</a>

						<a class="btn btn-xs btn-danger confirm-delete" href="#" data-id="{{$value->id}}">刪除</a>

					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{ $customers->links() }}
	</div>	

	<!--Delete Comfirm Dialog-->
	<div id="modal-delete" class="modal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
	            <h3>你確定嗎?</h3>
	        </div>
	        <div class="modal-body">
	             <p>如果想刪除此筆資料，點選'OK'?</p>
	        </div>
	        <div class="modal-footer">
	          <a href="#" id="btnDeleteYes" class="btn btn-default">OK</a>
	          <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">Cancel</a>
	        </div>
	      </div>
	    </div>
	</div>
</div>
<script>
	//handle delete comfirm dialog modal
	$('.confirm-delete').on('click', function(e) {
		e.preventDefault();

		var id = $(this).data('id');
		$('#modal-delete').data('id', id).modal('show');
	});

	$('#btnDeleteYes').click(function() {
		// handle deletion here
		var id = $('#modal-delete').data('id');
		var deletePath = "{{ URL::to('customers/') }}";
		$.ajax({
			url: deletePath+"/"+id,
			type: 'DELETE',
			success: function(){
				window.location.href = window.location.pathname;
			},
			error: function(){
				alert('刪除客戶功能失敗，請聯繫資訊人員');        
			}
		});
	});

	//Customer Search
	$("#searchButton").click(function(){
	    var searchText = ($('#searchText').val()=='')?'-':$('#searchText').val();
	    var path = "{{ URL::to('customerSearch') }}";

		window.location.href = path+"/"+searchText;
	});	
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>