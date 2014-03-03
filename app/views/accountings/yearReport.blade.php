@extends('layouts.master')

@section('js')
{{ HTML::script('assets/js/Chart.min.js'); }}
@stop

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $year }}年</h1>
		</div>
		<div class="col-md-4">
			<h1>
				<div class="input-group">
					<input class="form-control" name="report_at" type="text" id="report_at" placeholder="輸入想搜尋的年分, 例如: 2015">
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
		<div class="col-md-9">
			<canvas id="canvas" height="480" width="780"></canvas>
		</div>
		<div class="col-md-3">
			<table class="table table-bordered" id="monthTable">
				<tr id="startTable">
					<td>日期</td>
					<td>收入</td>
					<td>支出</td>
				</tr>
				
				<tr id="endTable">
					<td>總收入</td>
					<td colspan="2" align="right">{{$income}}</td>
				</tr>
				<tr>
					<td>總支出</td>
					<td colspan="2" align="right">{{$outcome}}</td>
				</tr>
				<tr>
					<td>營業額</td>
					<td colspan="2" align="right">{{$revenue}}</td>
				</tr>
			</table>
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
						<td>{{ $value->name }}</td>
						@if ($value->money_id == 0)
							<td><span class="btn btn-xs btn-primary">現金</span></td>
						@elseif($value->money_id == 1)
							<td><span class="btn btn-xs btn-warning">匯款</span></td>
						@else
							<td><a class="btn btn-xs btn-danger" id="bankCheck" href="#" data-id="{{$value->money_ref}}">支票</a></td>
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
	<script>
		//chart handle
		var income = new Array();
		var outcome = new Array();
		@for($i=1;$i<=12;$i++)
			income.push('{{ $monthInfo[$i]["income"] }}');
			outcome.push('{{ $monthInfo[$i]["outcome"] }}');
		@endfor
		var barData = {
			labels : ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
			datasets : [
				{
					fillColor : "#69D2E7",
					strokeColor : "rgba(220,220,220,1)",
					data : income
				},
				{
					fillColor : "#F38630",
					strokeColor : "rgba(151,187,205,1)",
					data : outcome
				}
			]
		}
		var myChart = new Chart(document.getElementById("canvas").getContext("2d"));
		var myPie = myChart.Bar(barData, {
			animationSteps: 100,
			animationEasing: 'easeOutBounce',
			scaleOverride: true,
		    scaleSteps: 11,
		    scaleStepWidth: Math.ceil({{ $maxMoney }} / 10),
		    scaleStartValue: 0
		});

		//handle edit comfirm dialog modal
		$('#bankCheck').on('click', function(e) {
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

		//Generate Year Report
		$("#searchButton").click(function(){
			if($('#report_at').val()==''){
				window.location.href = window.location.pathname;
			}else{
				var searchText = $('#report_at').val();
			    var path = "{{ URL::to('revenueYearReport') }}";
				window.location.href = path+"/"+searchText;
			}
		});

		//generate detail
		var monthArray = ["","一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"];
		@for($i=1;$i<=12;$i++)
			$("#endTable").before(
				"<tr>"+
					"<td>"+monthArray[{{ $i }}]+"</td>"+
					"<td align='right'>"+{{ $monthInfo[$i]["income"] }}+"</td>"+
					"<td align='right'>"+{{ $monthInfo[$i]["outcome"] }}+"</td>"+
				"</tr>"
			);
		@endfor
		
	</script>

	<style type="text/css">
		canvas {
		    width: 100% !important;
		    max-width: 780px;
		    height: auto !important;
		}
  	</style>
@stop