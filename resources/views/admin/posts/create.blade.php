@extends('layouts.admin')

@section('content')
	@include('includes.form_errors')

	<h1>Create Post</h1>

	<div class="row">
		{!! Form::open(['method'=>'POST', 'action'=> 'AdminPostsController@store', 'files'=>true]) !!}
		
		<div class="form-group">
			{!! Form::label('title', 'Title') !!}
			{!! Form::text('title', null, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('category_id', 'Category') !!}
			<!-- name, <option value=1>Active</option>, selected/default value, extra attribute add -->
			{!! Form::select('category_id', [''=> 'Choose category']+ $categories, null, ['class'=>'form-control']) !!}
		</div>


		<div class="form-group">
			{!! Form::label('photo_id', 'Photo') !!}
			{!! Form::file('photo_id', ['class'=>'form-control']) !!}
		</div>


		<div class="form-group">
			{!! Form::label('body', 'Description') !!}
			{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>10]) !!}
		</div>
		
		{!! Form::submit('Create Post', ['class'=>'btn btn-primary'])!!}

		{!! Form::close() !!}
	</div>	
@endsection