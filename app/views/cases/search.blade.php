@extends('layouts.master')
@section('content')

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

	    //prevent soft keypad on android
	    $('#startDate').click(function(){
	    	this.blur();
	    });
	    $('#endDate').click(function(){
	    	this.blur();
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
<h1>日期查詢</h1>

	<div class="form-group">
		<label>開始日期</label>
		<input class="form-control" name="startDate" type="text" id="startDate">
	</div>

	<div class="form-group">
		<label>結束日期</label>
		<input class="form-control" name="endDate" type="text" id="endDate" value="-">
	</div>

	<div class="form-group">
		<label>類型</label>
		<select class="form-control" id="typeId" name="typeId">
			<option value="All">全部</option>
			<option value="Common">一般事項</option>
			<option value="Electronic">請水電事項</option>
		</select>
	</div>

	<input class="btn btn-primary" type="button" value="查詢" id="search">

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/locales/bootstrap-datepicker.zh-TW.js"></script>

@stop