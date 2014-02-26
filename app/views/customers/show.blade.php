@extends('layouts.master')
@section('content')

<h1>客戶資料</h1>

	<div class="jumbotron">
		<h2>{{ $customer->name }}</h2>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td><strong>住址</strong></td>
					<td>{{ $customer->address }}</td>
				</tr>
				<tr class="success">
					<td><strong>電話</strong> </td>
					<td>{{ $customer->phone }}</td>
				</tr>
				<tr>
					<td><strong>手機</strong></td>
					<td>{{ $customer->mobile }}</td>
				</tr>			
			</tbody>
		</table>
	</div>

</div>

@stop