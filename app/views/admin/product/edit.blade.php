@extends('admin.layout.default')

@section('title')
{{ $title='Chỉnh sửa product' }}
@stop

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('ProductController@update', $data->id), 'method' => 'PUT', 'files' => true)) }}
			<div class="box-body">
				<div class="form-group">
					<label for="title">User</label>
					<div class="row">
						<div class="col-sm-6">
							<?php $user = User::find($data->user_id); ?>
						   <p>ID: {{ $data->user_id }}</p>
						   <p>Username: {{ $user->username }}</p>
						   <p>Email: {{ $user->email }}</p>
						   <p>City: {{ $data->city }}</p>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="title">Tên</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('name', $data->name, array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="title">Mô tả</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::textarea('description', $data->description, array('class' => 'form-control', "rows"=>6 )) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name">Giá tiền</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::text('price', $data->price, array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name">Thể loại</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::select('category_id', Category::lists('name', 'id'), $data->category_id, array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name">Cũ / Mới</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::select('type_id', selectProductType(), $data->type_id, array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="title">Địa chỉ</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('address', $data->address, array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="image_url">Avatar</label>
					<div class="row">
						<div class="col-sm-6">
							<img class="image_fb" src="{{ url(PRODUCT_UPLOAD .'/'. $data->user_id . '/' . $data->avatar) }}" />
						</div>
					</div>
				</div>
			  	<!-- /.box-body -->
				<div class="box-footer">
					{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
				</div>
			{{ Form::close() }}
		</div>
		<!-- /.box -->
	</div>
</div>
@include('admin.common.ckeditor')
@stop
