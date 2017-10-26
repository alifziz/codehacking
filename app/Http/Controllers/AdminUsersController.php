<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// Requesta
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;

// Models
use App\User;
use App\Role;
use App\Photo;

// Session facade
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users
        $users = User::all();

        // Pass data as variable in view file
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all roles - lists() - returns result as array - but gotta use all() to get those value -- lists() - is deprecated - so use pluck()
        // $roles = Role::lists('name', 'id')->all();

        $roles = Role::pluck('name', 'id')->all();

        // Pass value to db
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        // Check if user submitted a password
        if(trim($request->password) == ''){
            // Get all values except password - except() laravel function
            $input = $request->except('password');
        }else{
            $input = $request->all();
            // Encrypt password
            $input['password'] = bcrypt($request->password);
        }


        // Check if user submitted a file - db users table column name
        if($file = $request->file('photo_id')){
            // Prepare photo name
            $name = time()."_".$file->getClientOriginalName();
            
            // Move file to public/images folder
            $file->move('images', $name);

            // Insert photo to photo table - needs to be array - single value won't pass - as name was single variable not array - array needs to be added -  'file' = column name in photos table
            $photo = Photo::create(['file'=>$name]);

            // Prepare photo_id into input array - which we get automatically if we create a new photo record in photos table
           $input['photo_id'] = $photo->id;           
        }

        // Encrypt password with hash -  from $request array password key
        $input['password'] = bcrypt($request->password);

        // Insert photo_id(if any) and every other user input in users table
        // $input variable is already an array
        User::create($input);

        // Flash message - session
        Session::flash('created_user','User Created'); 


        // Redirect to all users page - route which will redirect to AdminUsersController@index method
        return redirect('/admin/users');    

        // -------------------------
        // Create new user / persist data to database
        // uploaded file / image will not be included as 
        // when uploaded file submitted with post method it will be empty
        // User::create($request->all());
        
        // Redirect to admin/users route
        //return redirect('/admin/users');
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
        // Find user
        $user = User::findOrFail($id);

        // Get all roles - lists() - returns result as array - but gotta use all() to get those value -- lists() - is deprecated - so use pluck()
        $roles = Role::pluck('name', 'id')->all();

        // Pass value to view
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        // Get user
        $user = User::findOrFail($id);


        // Check if user submitted a password
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            // Get all user input
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
       

        // Check if new image was uploaded
        if($file = $request->file('photo_id')){
            $name = time()."_".$file->getClientOriginalName();

            // Move image to images folder
            $file->move('images', $name);

            // Insert photo and get id
            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;
        }

        // Update
        $user->update($input);


        // Flash message - session
        Session::flash('updated_user','User Info Updated');


        // Redirect - to all users page - route which will redirect to AdminUsersController@index method
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete user
        $user = User::findOrFail($id);

        // Get photo id
        $photo_id = $user->photo_id;

        // Remove image from public folder - photo() as dynamic property
        if($photo_id != ''){
            unlink(public_path().$user->photo->file);
        }   

        // Delete user
        $user->delete();

        // Delete photo from photos table
        $photo = Photo::findOrFail($photo_id)->delete();

        
        // Flash message - session
        Session::flash('deleted_user','User Deleted');

        // Redirect to admin/users route
        return redirect('/admin/users');
    }
}
