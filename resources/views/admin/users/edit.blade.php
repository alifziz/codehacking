@extends('layouts.admin')

@section('content')
	<h1>Edit User</h1>
	
	<div class="row">
		<div class="col-sm-3">
			<!-- Default image -->
			<img src="{{$user->photo ? $user->photo->file : '/images/demo.png'}}" alt="" class="img-responsive img-rounded" height="50">
		</div>

		<div class="col-sm-9">
			<!-- Form model binding  -->
			{!! Form::model($user, ['method'=>'PATCH', 'action'=> ['AdminUsersController@update', $user->id], 'files'=> true])!!}

				<div>
					{!! Form::label('photo_id', 'Photo')!!}
					{!! Form::file('photo_id', ['class' => 'form-control'])!!}
					<br>
				</div>

				<div class="form-group">
					{!! Form::label('name', 'Name') !!}
					<!-- null is default - so if value found that will show-->
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Write Your Name'])!!}
				</div>


				<div class="form-group">
					{!! Form::label('email', 'Email') !!}
					<!-- null is default - so if value found that will show-->
					{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Write Your Email'])!!}
				</div>
				

				<div class="form-group">
					{!! Form::label('is_active', 'Status') !!}
					<!-- name, <option value=1>Active</option>, if has null(no default given) - laravel will insert user info here, extra attribute add -->

					{!! Form::select('is_active', [1=>'Active', 0=>'Not Active'], null, ['class'=>'form-control']) !!}
				</div>


				<div class="form-group">
					{!! Form::label('role_id', 'Role') !!}
					<!-- name, <option value=1>Active</option>+ to concatenate array from AdminUsersController@create, if has null(no default given) - laravel will insert user info here, extra attribute add -->
					{!! Form::select('role_id', $roles, null, ['class' => 'form-control'])!!}
				</div>


				<div class="form-group">
					{!! Form::label('password', 'Password') !!}
					{!! Form::password('password',  ['class' => 'form-control'])!!}
				</div>
					
				{!! Form::submit('Edit User', ['class'=>'btn btn-primary']) !!}

			{!! Form::close() !!}
		</div>

	</div>	

	<br><br>
	<div class="row">
		<!-- Error message include -->
		@include('includes.form_errors')
	</div>
	

@stop