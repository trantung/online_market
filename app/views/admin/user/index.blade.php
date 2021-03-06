@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý User' }}
@stop

@section('content')
@include('admin.user.search')

<div class="row">
	<div class="col-xs-12">
	  	<div class="box">
			<div class="box-header">
				<h3 class="box-title">Danh sách User</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			  	<table class="table table-hover">
					<tr>
						<th>ID</th>
						<th>Phone</th>
						<th>Tài khoản</th>
						<th>Loại tài khoản</th>
						<th>Email</th>
						<th>Tên</th>
						<th>Trạng thái</th>
						<th>Action</th>
					</tr>
					@foreach($inputUser as $value)
					<tr>
						<td>{{ $value->id }}</td>
						<td>{{ $value->phone }}</td>
						<td>{{ $value->username }}</td>
						<td>{{ CommonUser::getUsername($value->id)['type_user'] }}</td>
						<td>{{ $value->email }}</td>
						<td>{{ $value->fullname }}</td>
						<td>{{ CommonUser::getStatus($value->status) }}</td>
						<td>
							@if($value->status == ACTIVE )
							<a href="{{action('UserController@edit', $value->id) }}" class="btn btn-danger">Hủy kích hoạt</a>
							@else
							<a href="{{action('UserController@edit', $value->id) }}" class="btn btn-primary">Kích hoạt</a>
							@endif
							@if(CommonUser::getUsername($value->id)['type_user'] == TYPESYSTEM)
							<a href="{{ action('UserController@changepassword', $value->id) }}" class="btn btn-primary">Đổi mật khẩu</a>
							@endif
							<!-- 		{{ Form::open(array('method'=>'DELETE', 'action' => array('UserController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
							<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
							{{ Form::close() }} -->
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
		<ul class="pagination">
			<!-- phan trang -->
			{{ $inputUser->appends(Request::except('page'))->links() }}
		</ul>
	</div>
</div>

@stop

