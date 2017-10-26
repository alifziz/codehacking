@extends('layouts.admin')

@section('content')
	<h1>All Posts</h1>

	<table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Body</th>
        <th>Author</th>
       <th>Category</th>
        <th>Created at</th>
        <th>Updated at</th>
      </tr>
    </thead>
    <tbody>
    	@if($posts)
    		@foreach($posts as $post)
		      <tr>
		        <td>{{$post->id}}</td>
                <td><img src="{{$post->photo ? $post->photo->file : '/images/demo.png'}}" height="40"></td>
                <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
                <td>{{$post->body}}</td>    
    			
                <!-- Relationship defined as user() in user model so dynamic variable -->
                <td>{{$post->user != '' ? $post->user->name : 'No author set'}}</td>   
                
                <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>


                <!-- Carbon facades for human date time modification  -->
		        <td>{{$post->created_at->diffForHumans()}}</td>
		        <td>{{$post->updated_at->diffForHumans()}}</td>
		      </tr>
      		@endforeach
      	@endif
     
    </tbody>
  </table>
	
@endsection