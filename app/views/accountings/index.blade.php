@extends('layouts.master')

@section('js')
{{ HTML::script('assets/js/Chart.min.js'); }}
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/locales/bootstrap-datepicker.zh-TW.js"></script>
@stop

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $year }}年 {{ $month }}月份</h1>
		</div>
		<div class="col-md-4">
			<h1>
				<div class="input-group">
					<input class="form-control" name="report_at" type="text" id="report_at" placeholder="輸入想搜尋的月份">
					<div class="input-group-btn">
			            <button class="btn btn-default" type="submit" id="searchButton"><i class="glyphicon glyphicon-search"></i></button>
			        </div>
				</div>
			</h1>
		</div>	
	</div>	
	<br>
	<div class="row jumbotron">
		<h2>收支比例圖</h2>
		<br>
		<div class="col-md-5">
			<canvas id="canvas" height="480" width="480"></canvas>
		</div>
		<div class="col-md-5">
			<div>
				<h3>收入 - {{ $income }}</h3>
			</div>
			<div>
				<h3>支出 - {{ $outcome }} </h3>
			</div>
		</div>		
	</div>
	<div>
		<h2>收支表</h2>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<td>日期</td>
					<td>客戶名稱</td>
					<td>類型</td>
					<td>收入</td>
					<td>支出</td>
				</tr>
			</thead>
			<tbody>
				@foreach($accountings as $key => $value)
					<tr>
						<td>{{ $value->created_date }}</td>
						<td class="colName" data-id="{{$value->id}}" data-name="{{$value->name}}">{{ $value->name }}</td>
						@if ($value->money_id == 0)
							<td><span class="btn btn-xs btn-primary">現金</span></td>
						@elseif($value->money_id == 1)
							<td><span class="btn btn-xs btn-warning">匯款</span></td>
						@else
							<td><a class="btn btn-xs btn-danger bankCheck" href="#" data-id="{{$value->money_ref}}">支票</a></td>
						@endif

						@if ($value->type == 0)
							<td align="right">{{ $value->money }}</td>
							<td></td>
						@else
							<td></td>
							<td align="right">{{ $value->money }}</td>
						@endif
					</tr>
				@endforeach
				<tr>
					<td colspan="3"></td>
					<td align="right">{{ $income }}</td>
					<td align="right">{{ $outcome }}</td>
				</tr>
				<tr>
					<td colspan="3">營業額</td>
					<td colspan="2" align="right">{{ $revenue }}</td>
				</tr>
			</tbody>
		</table>		
	</div>
	<!--bankCheck Comfirm Dialog-->
	<div id="modal-bankCheck" class="modal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
	            <h3>支票詳細</h3>
	        </div>
	        <div class="modal-body">
	            <div class="form-group">
					<label>代收日期</label>
					<input class="form-control" name="created_at" type="text" id="created_at">
				</div>
				<div class="form-group">
					<label>支票號碼</label>
					<input class="form-control" name="check_number" type="text" id="check_number">
				</div>
				<div class="form-group">
					<label>到期日</label>
					<input class="form-control" name="expired_at" type="text" id="expired_at">
				</div>
				<div class="form-group">
					<label>備註</label>
					<input class="form-control" name="check_notes" type="text" id="check_notes">
				</div>	
	        </div>
	        <div class="modal-footer">
	          <a href="#" id="btnEditYes" class="btn btn-default">OK</a>
	          <a href="#" id="btnEditNo" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">Cancel</a>
	        </div>
	      </div>
	    </div>
	</div>
		<!--bankCheck Comfirm Dialog-->
	<div id="modal-delete" class="modal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
	            <h3>刪除帳款</h3>
	        </div>
	        <div id="modal-body" class="modal-body">
	            <!--Get from long press-->
	        </div>
	        <div class="modal-footer">
	          <a href="#" id="btnDeleteYes" class="btn btn-default">OK</a>
	          <a href="#" id="btnDeleteNo" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">Cancel</a>
	        </div>
	      </div>
	    </div>
	</div>	
	<script>
	$(function(){
		//chart handle
		var pieData = [
			{
				value : {{ $income }},
				color : "#69D2E7",
				label : '收入',
				labelColor : 'white',
				labelFontSize : '2em',
				labelAlign : 'center'
			},
			{
				value : {{ $outcome }},
				color : "#F38630",
				label : '支出',
				labelColor : 'white',
				labelFontSize : '2em',
				labelAlign: 'center'
			}
		];

		var myChart = new Chart(document.getElementById("canvas").getContext("2d"));
		var myPie = myChart.Pie(pieData, {
			animationSteps: 100,
			animationEasing: 'easeOutBounce'
		});

		//handle edit bankCheck comfirm dialog modal
		$('.bankCheck').on('click', function(e) {
			e.preventDefault();

			var id = $(this).data('id');
			var path = "{{ URL::to('bankCheck/index-byid') }}";

			$.ajax({
				url: path+"/"+id,
				type: 'GET',
				success: function(data){
					$('#created_at').val(data.created_date);
		            $('#check_number').val(data.check_number);
		            $('#expired_at').val(data.expired_date);
		            $('#check_notes').val(data.notes);

					$('#modal-bankCheck').data('id', id).modal('show');
				},	
				error: function(){
					alert('支票讀取失敗，請聯繫資訊人員');        
				}
			});
		});

		$('#btnEditYes').click(function() {
		// handle deletion here
			var id = $('#modal-bankCheck').data('id');
			var path = "{{ URL::to('bankCheck/update-byid') }}";
			$.ajax({
				url: path+"/"+id,
				type: 'PUT',
				data: {
		            'created_date': $('#created_at').val(),
		            'check_number': $('#check_number').val(),
		            'expired_date': $('#expired_at').val(),
		            'notes': 		$('#check_notes').val()
		        },
				success: function(){
						window.location.href = window.location.pathname;
				},
				error: function(){
					alert('編輯支票功能失敗，請聯繫資訊人員');        
				}
			});
		});

		//choose date
		$('#report_at').click(function(){
		   this.blur();
		});
		$('#report_at').datepicker({
			    format: "yyyy-mm",
	    		autoclose: true,
	    		language: 'zh-TW',
	    		viewMode: "months", 
    			minViewMode: "months"
		});

		//Generate Month Report
		$("#searchButton").click(function(){
			if($('#report_at').val()==''){
				window.location.href = window.location.pathname;
			}else{
				var searchText = $('#report_at').val();
			    var splitText = searchText.split("-");
			    var path = "{{ URL::to('revenueMonthReport') }}";
				window.location.href = path+"/"+splitText[0]+"/"+splitText[1];
			}
		});

		//
		var pressTimer;
		$(".colName").mouseup(function(){
		  	clearTimeout(pressTimer)
		  	// Clear timeout
		  	return false;
		}).mousedown(function(){
		  
			var id = $(this).data('id');
			var name = $(this).data('name');
		  	// Set timeout
		  	pressTimer = window.setTimeout(function() {
		  		$('#modal-body').empty();
		  		$('#modal-body').append("<p>確認刪除'"+name+"'嗎?</p>");
		  		$('#modal-delete').data('id', id).modal('show');
		  	},500)
		  	return false; 
		});
		$('#btnDeleteYes').click(function() {
			// handle deletion here
			var id = $('#modal-delete').data('id');
			var deletePath = "{{ URL::to('accountings/') }}";
			$.ajax({
				url: deletePath+"/"+id,
				type: 'DELETE',
				success: function(){
					window.location.href = window.location.pathname;
				},
				error: function(){
					alert('刪除帳款功能失敗，請聯繫資訊人員');        
				}
			});
		});
	});		
	</script>

	<style type="text/css">
		canvas {
		    width: 100% !important;
		    max-width: 480px;
		    height: auto !important;
		}
  	</style>
@stop