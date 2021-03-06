@extends('admin.layout.default')
@if(Admin::isAdmin())
@section('title')
{{ $title='Quản lý Product' }}
@stop

@section('content')

	<div class="row margin-bottom">
		<div class="col-xs-12">
			{{-- <a href="" class="btn btn-primary">Thêm</a> --}}
		</div>
	</div>

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
							<th>Name</th>
							<th>Price</th>
							<th>Type</th>
							<th>User</th>
							<th>Category</th>
							<!-- <th>City</th> -->
							<th>Status</th>
							<th style="width:300px;">Action</th>
						</tr>
						@foreach($data as $key => $value)
							<tr>
								<td>{{ $value->id }}</td>
								<td>{{ $value->name }}</td>
								<td>{{ getFullPriceInVnd($value->price) }}</td>
								<td>{{ getProductType($value->type_id) }}</td>
								<td>{{ Common::getModelField($value->user_id, 'User', 'username') }}</td>
								<td>{{ Common::getModelField($value->category_id, 'Category', 'name') }}</td>
								<!-- <td>{{-- City::find($value->city_id)->name --}}</td> -->
								<td>{{ getProductStatus($value->status) }}</td>
								<td>
								@if($value->status == ACTIVE)
									<a href="{{ action('ProductController@check', $value->id) }}" class="btn btn-danger">Bỏ duyệt</a>
								@else
									<a href="{{ action('ProductController@check', $value->id) }}" class="btn btn-primary">Duyệt</a>
								@endif
								{{ Form::open(array('method'=>'GET', 'action' => array('ProductController@refuse', $value->id), 'style' => 'display: inline-block;')) }}
									<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn từ chối?');">Từ chối</button>
								{{ Form::close() }}
								<a href="{{ action('ProductController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
								{{ Form::open(array('method'=>'DELETE', 'action' => array('ProductController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
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

@endif
