@extends('layouts.master')
@section('content')

<h1>新增帳款</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'accountings')) }}

	
	<div class="form-group">
		<label>客戶名稱</label>
		<div class="input-group">
				<input class="form-control" name="name" type="text" id="name" placeholder="右側按鈕可以直接選擇已收款客戶">
				<div class="input-group-btn">
		            <a class="btn btn-default" id="userButton" href="#"><i class="glyphicon glyphicon-user"></i></a>
		        </div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('type', '類型') }}
		{{ Form::select('type', array('0' => '收入', '1' => '支出'), Input::old('type'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('money_id', '款項類型') }}
		{{ Form::select('money_id', array('0' => '現金', '1' => '匯款', '2' => '支票'), Input::old('money_id'), array('class' => 'form-control')) }}
	</div>

	<div id="bankAccount" class="jumbotron">
		<div class="form-group">
			<label>帳戶號碼</label>
			<select id="account_number" name="account_number" class="form-control">
    		    	<option>請選擇帳戶號碼</option>
    		</select>
		</div>
	</div>

	<div id="bankCheck" class="jumbotron">
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

	<div class="form-group">
		<label>日期</label>
		<input class="form-control" name="startDate" type="text" id="startDate">
	</div>

	<div class="form-group">
		{{ Form::label('money', '金額') }}
		{{ Form::text('money', Input::old('money'), array('class' => 'form-control')) }}
	</div>	

	{{ Form::submit('新增', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
	
	<!--User Comfirm Dialog-->
	<div id="modal-user" class="modal">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	            <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
	            <h3>選擇已收款的客戶?</h3>
	        </div>
	        <div class="modal-body">
	             <div class="form-group">
					<label>客戶名稱</label>
					<select id="account_user" name="account_user" class="form-control">
		    		    	<option>請選擇客戶</option>
		    		</select>
				</div>
	        </div>
	        <div class="modal-footer">
	          <a href="#" id="btnUserYes" class="btn btn-default">OK</a>
	          <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">Cancel</a>
	        </div>
	      </div>
	    </div>
	</div>

<script>
	$(function(){
		$("#money_id").change(function() {
		   	if($(this).val() == 0){
		   		$("#bankAccount").hide('fast');	
		   		$("#bankCheck").hide('fast');
		   	}else if($(this).val() == 1){
		   		$("#bankAccount").show('fast');
		   		$("#bankCheck").hide('fast');
		   		$.get("{{ url('bankAccount')}}", 
					{ option: $(this).val() }, 
					function(data) {
						var model = $('#account_number');
						model.empty();
	 
						$.each(data, function(index, element) {
				            model.append("<option value='"+ element.id +"'>" + element.account_number+" - "+element.name+ "</option>");
					    });
					});
		   	}else{
		   		$("#bankCheck").show('fast');	
		   		$("#bankAccount").hide('fast');	
		   	}

	  	});

	  	$("#userButton").click(function(){
			$('#modal-user').modal('show');
			$.get("{{ url('electronicPaidCase')}}",
					function(data) {
						var model = $('#account_user');
						model.empty();
	 
						$.each(data, function(index, element) {
				            model.append("<option value='"+ element.id +"'>" + element.name + "</option>");
					    });
			});    
		});
		$("#btnUserYes").click(function() {
			$.get("{{ url('cases')}}"+"/"+$('#account_user :selected').val()+"/edit",
					function(data) {
						$('#name').val(data.name);
						$('#money').val(data.money);
			});
			$('#modal-user').modal('hide'); 
		});
		

	  	$("#bankAccount").hide();
	  	$("#bankCheck").hide();
		
		//prevent soft keypad on android
		$('#startDate').click(function(){
		   this.blur();
		});
		$('#startDate').datepicker({
			    format: "yyyy-mm-dd",
	    		autoclose: true,
	    		language: 'zh-TW'
		});

		$("#startDate").datepicker("setDate", new Date());
		$("#startDate").datepicker('update');

		$('#created_at').click(function(){
		   this.blur();
		});
		$('#created_at').datepicker({
			    format: "yyyy-mm-dd",
	    		autoclose: true,
	    		language: 'zh-TW'
		});

		$('#expired_at').click(function(){
		   this.blur();
		});
		$('#expired_at').datepicker({
			    format: "yyyy-mm-dd",
	    		autoclose: true,
	    		language: 'zh-TW'
		});
	});
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/locales/bootstrap-datepicker.zh-TW.js"></script>

@stop