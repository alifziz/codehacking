@extends('layouts.admin')


@section('content')

  @if(Session::has('created_user'))
    <!-- session() global function -->
    <p class="alert alert-success">{{session('created_user')}}</p>
  @endif


  @if(Session::has('updated_user'))
    <!-- session() global function -->
    <p class="alert alert-success">{{session('updated_user')}}</p>
  @endif


  @if(Session::has('deleted_user'))
    <!-- session() global function -->
    <p class="alert alert-danger">{{session('deleted_user')}}</p>
  @endif


	<h1>Users</h1>
	
	<table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Updated at</th>
      </tr>
    </thead>
    <tbody>
    	@if($users)
    		@foreach($users as $user)
		      <tr>
		        <td>{{$user->id}}</td>
            <!-- user model photo() method -->
            <td><img src="{{$user->photo ? $user->photo->file : '/images/demo.png'}}" height="40"></td>
		        <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
		        <td>{{$user->email}}</td>
            <!-- relationship defined in user model so dynamic variable -->
		        <td>{{$user->role_id == 0 ? 'Role Not Set' : $user->role->name}}</td>
		        <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
		        <td>{{$user->created_at->diffForHumans()}}</td>
		        <td>{{$user->updated_at->diffForHumans()}}</td>
		      </tr>
      		@endforeach
      	@endif
     
    </tbody>
  </table>

@stop