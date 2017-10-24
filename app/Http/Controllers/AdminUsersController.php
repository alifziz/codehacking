<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// Request
use App\Http\Requests\UsersRequest;

// Models
use App\User;
use App\Role;
use App\Photo;

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
        // User input as variable
        $input = $request->all();

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
        //
        return view('admin.users.edit');
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
