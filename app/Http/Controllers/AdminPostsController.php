<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// Custom Requests
use App\Http\Requests\PostCreateRequest;

// User authorization - to check if user logged in 
use Illuminate\Support\Facades\Auth; 

// Models
use App\Post;
use App\User;
use App\Photo;
use App\Category;


class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all posts from
        $posts = Post::all();

        // Pass posts to view 
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get categories
        $categories = Category::pluck('name', 'id')->all();
    
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        // Check if user is logged in, then use user credential
        // to create post 
        $user = Auth::user();

        // User submitted data
        $input = $request->all();

        // If photo was uploaded - photo_id is column name in posts table
        if($file = $request->file('photo_id')){
            // Get orignal name and make it unique
            $name = time()."_".$file->getClientOriginalName();

            // Move file to images folder
            $file->move('images', $name);

            // Upload photo to photos table
            $photo = Photo::create(['file'=>$name]);

            // Get photo id and set it to input array
            $input['photo_id'] = $photo->id;
        }

        // Create a post in posts table with logged in user's credential
        // posts() method defined in User model
        $user->posts()->create($input);

        // Redirect to all posts page route
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.posts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
