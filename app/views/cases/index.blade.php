<!-- app/views/caes/index.blade.php -->

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
				<!--<li class="dropdown-toggle"><a href="#" class="dropdown-toggle" data-toggle="dropdown">會計相關</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="{{ URL::to('bankAccount/create') }}">新增帳戶</a></li>
						<li><a tabindex="-1" href="#">新增帳款</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="#">帳戶查詢</a></li>
						<li><a tabindex="-1" href="#">報表</a></li>
					</ul>
				</li>-->
				<li><a href="{{ URL::to('logout') }}">登出</a></li>
			</ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container">

@if (Session::has('caseTitle'))
	<h1>{{ Session::get('caseTitle') }}</h1>
@endif

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

	<table class="table table-bordered">
		<thead>
			<tr>
				<td>姓名</td>
				
				<td>功能</td>
			</tr>
		</thead>
		<tbody>
		@foreach($cases as $key => $value)
			<tr>
				<td>{{ $value->name }}</td>
				
				<!-- we will also add show, edit, and delete buttons -->
				<td>
					@if ($value->level == 0)
							<a class="btn btn-xs btn-primary confirm-done" href="#" data-id="{{$value->id}}">完工</a>	
					@elseif($value->level == 1)
						<a class="btn btn-xs btn-primary" disabled="disabled" href="#">未收款</a>
					@else
						<a class="btn btn-xs btn-warning" href="#">已收款</a>	
					@endif
					<!-- Single button -->
					<div class="btn-group">
					  <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown">
					    功能清單 <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
					    <li><a href="{{ URL::to('cases/' . $value->id) }}">資料</a></li>
					    <li><a class="confirm-edit" href="#" data-id="{{$value->id}}">編輯</a></li>
					    <li><a class="confirm-delete" href="#" data-id="{{$value->id}}">刪除</a></li>
					    <li class="divider"></li>
					    <li><a class="confirm-transfer" href="#" data-id="{{$value->id}}">新增至客戶</a></li>
					  </ul>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{{ $cases->links() }}
	<!--<ul class="pager">
	  <li><a href="#">Previous</a></li>
	  <li><a href="#">Next</a></li>
	</ul>-->

	<!--Done Comfirm Dialog-->
	<div id="modal-done" class="modal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
	            <h3>完工了嗎?</h3>
	        </div>
	        <div class="modal-body">
	             <p>如果已完工，點選'OK'</p>
	        </div>
	        <div class="modal-footer">
	          <a href="#" id="btnDoneYes" class="btn btn-default">OK</a>
	          <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">Cancel</a>
	        </div>
	      </div>
	    </div>
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

	<!--Transfer Comfirm Dialog-->
	<div id="modal-transfer" class="modal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
	            <h3>轉換至客戶?</h3>
	        </div>
	        <div class="modal-body">
	             <p>若確定將此事項資料新增至客戶，點選'OK'</p>
	        </div>
	        <div class="modal-footer">
	          <a href="#" id="btnTransferYes" class="btn btn-default">OK</a>
	          <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">Cancel</a>
	        </div>
	      </div>
	    </div>
	</div>

	<!-- edit page -->
	<div id="modal-edit" class="modal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
	            <h3>編輯</h3>
	        </div>
	        <div class="modal-body">
				<div class="form-group">
					{{ Form::label('name', '姓名') }}
					{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('typeId', '類型') }}
					{{ Form::select('typeId', array('0' => '預設事項', '1' => '水', '2' => '電(新設)', '3' => '電(增設)', '4' => '電(分戶)', '5' => '電(噴霧)'), Input::old('typeId'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('description', '工作內容') }}
					{{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('address', '住址') }}
					{{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('phone', '電話') }}
					{{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('mobile', '手機') }}
					{{ Form::text('mobile', Input::old('mobile'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('invoice', '發票號碼') }}
					{{ Form::text('invoice', Input::old('invoice'), array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('money', '金額') }}
					{{ Form::text('money', Input::old('money'), array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					<input class="form-control" id ="level" name="level" type="hidden">
				</div>
				<div id="errorMessage"></div>	             
	        </div>
	        <div class="modal-footer">
	          <a href="#" id="btnEditYes" class="btn btn-default">OK</a>
	          <a href="#" id="btnEditNo" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">Cancel</a>
	        </div>
	      </div>
	    </div>
	</div>

</div>
<script>
	//handle done comfirm dialog modal
	$('.confirm-done').on('click', function(e) {
		e.preventDefault();

		var id = $(this).data('id');
		$('#modal-done').data('id', id).modal('show');
	});
	$('#btnDoneYes').click(function() {
		// handle deletion here
		var id = $('#modal-done').data('id');
		var path = "{{ URL::to('finishedCase/') }}";
		$.ajax({
			url: path+"/"+id,
			type: 'POST',
			success: function(){
				window.location.href = window.location.pathname;
			},
			error: function(){
				alert('完工功能失敗，請聯繫資訊人員');        
			}
		});
	});

	//handle transfer comfirm dialog modal
	$('.confirm-transfer').on('click', function(e) {
		e.preventDefault();

		var id = $(this).data('id');
		$('#modal-transfer').data('id', id).modal('show');
	});
	$('#btnTransferYes').click(function() {
		// handle deletion here
		var id = $('#modal-transfer').data('id');
		var path = "{{ URL::to('transferToCustomer/') }}";
		$.ajax({
			url: path+"/"+id,
			type: 'POST',
			success: function(){
				window.location.href = "{{ URL::to('customers') }}";
			},
			error: function(){
				alert('轉換功能失敗，請聯繫資訊人員');        
			}
		});
	});

	//handle edit comfirm dialog modal
	$('.confirm-edit').on('click', function(e) {
		e.preventDefault();

		var id = $(this).data('id');
		var path = "{{ URL::to('cases/') }}";

		$.ajax({
			url: path+"/"+id+"/edit",
			type: 'GET',
			success: function(data){
				$('#name').val(data.name);
	            $('#typeId').val(data.typeId);
	            $('#description').val(data.description);
	            $('#address').val(data.address);
	            $('#phone').val(data.phone);
	            $('#mobile').val(data.mobile);
	            $('#invoice').val(data.invoice);
	            $('#money').val(data.money);
	            $('#level').val(data.level);
				$('#modal-edit').data('id', id).modal('show');
			},	
			error: function(){
				alert('編輯功能失敗，請聯繫資訊人員');        
			}
		});

	});
	$('#btnEditYes').click(function() {
		// handle deletion here
		var id = $('#modal-edit').data('id');
		var path = "{{ URL::to('cases') }}";
		$.ajax({
			url: path+"/"+id,
			type: 'PUT',
			data: {
	            'name': 		$('#name').val(),
	            'typeId': 		$('#typeId').val(),
	            'description': 	$('#description').val(),
	            'address': 		$('#address').val(),
	            'phone': 		$('#phone').val(),
	            'mobile': 		$('#mobile').val(),
	            'invoice': 		$('#invoice').val(),
	            'money': 		$('#money').val(),
	            'level': 		$('#level').val()

	        },
			success: function(){
					window.location.href = window.location.pathname;
			},
			error: function(){
				alert('編輯功能失敗，請聯繫資訊人員');        
			}
		});
	});
	//hndle delete comfirm page dialog modal
	$('.confirm-delete').on('click', function(e) {
		e.preventDefault();

		var id = $(this).data('id');
		$('#modal-delete').data('id', id).modal('show');
	});
	$('#btnDeleteYes').click(function() {
		// handle deletion here
		var id = $('#modal-delete').data('id');
		var deletePath = "{{ URL::to('cases/') }}";
		$.ajax({
			url: deletePath+"/"+id,
			type: 'DELETE',
			success: function(){
				window.location.href = window.location.pathname;
			},
			error: function(){
				alert('刪除功能失敗，請聯繫資訊人員');        
			}
		});
	});		
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>