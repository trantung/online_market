@extends('admin.layout.default')
@section('title')
{{ $title='Quản lý feedback' }}
@stop

@section('content')

	<div class="row">
		<div class="col-xs-12">
		  	<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th>ID</th>
							<th style="width:50%;">Message</th>
							<th>User</th>
							<th>Product</th>
							<th style="width:260px;">Action</th>
						</tr>
						@foreach($data as $key => $value)
							<tr>
								<td>{{ $value->id }}</td>
								<td>{{ nl2br($value->message) }}</td>
								<td>{{ User::find($value->user_id)->username }}</td>
								<td>{{ Product::find($value->product_id)->name }}</td>
								<td>
								{{ Form::open(array('method'=>'DELETE', 'action' => array('FeedbackController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
									<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
								{{ Form::close() }}
								</td>
							</tr>
						@endforeach
					</table>
				</div>
				<!-- /.box-body -->
		  	</div>
		  	<!-- /.box -->
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			{{ $data->appends(Request::except('page'))->links() }}
		</div>
	</div>

@stop

