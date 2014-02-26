@extends('layouts.master')
@section('content')

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

@stop