@extends('layouts.master')
@section('content')

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

@stop