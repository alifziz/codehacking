<?php

use App\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


/*
|--------------------------------------------------------------------------
| Admin Routes Group
|--------------------------------------------------------------------------
|
*/
Route::get('/admin', function(){
	return view('admin.index');
});

Route::group(['middleware'=> 'admin'], function(){
	Route::resource('/admin/users', 'AdminUsersController');

	// Posts are available for admin users  - for now
	Route::resource('/admin/posts', 'AdminPostsController');
});

/*Route::get('/role',function(){
	$user = User::find(1);

	echo $user->role->name;
});*/