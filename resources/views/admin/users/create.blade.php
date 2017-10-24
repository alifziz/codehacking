@extends('layouts.admin')

@section('content')
	<h1>Create User</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=> true])!!}
		<div class="form-group">
			{!! Form::label('name', 'Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Write Your Name'])!!}
		</div>


		<div class="form-group">
			{!! Form::label('email', 'Email') !!}
			{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Write Your Email'])!!}
		</div>
		

		<div class="form-group">
			{!! Form::label('is_active', 'Status') !!}
			<!-- name, <option value=1>Active</option>, selected/default value, extra attribute add -->
			{!! Form::select('is_active', [1=>'Active', 0=>'Not Active'], 0, ['class'=>'form-control']) !!}
		</div>


		<div>
			{!! Form::label('file', 'Photo')!!}
			{!! Form::file('file', ['class' => 'form-control'])!!}
			<br>
		</div>


		<div class="form-group">
			{!! Form::label('role_id', 'Role') !!}
			<!-- name, <option value=1>Active</option>+ to concatenate array from AdminUsersController@create, selected value, extra attribute add -->
			{!! Form::select('role_id', [''=> 'Choose a role'] + $roles, null, ['class' => 'form-control'])!!}
		</div>


		<div class="form-group">
			{!! Form::label('password', 'Password') !!}
			{!! Form::password('password', ['class' => 'form-control'])!!}
		</div>
			
		{!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}

	{!! Form::close() !!}

	<br><br>
	
	<!-- Error message include -->
	@include('includes.form_errors')

@stop