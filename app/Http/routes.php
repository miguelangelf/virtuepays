<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});


Route::post('average', [
    'as' => 'average', 'uses' => 'PostController@average'
]);





Route::group(['middleware' => 'web'], function () {


	Route::get('links',function(){
		return view('links');
	});



	Route::get('/',function(){
		return view('init.inicio');
	});


	
    Route::auth();

    Route::post('setrate','PostController@setrate')->middleware('auth');
    Route::post('myrate','PostController@getmyRate')->middleware('auth');

    


    /*-----------------------------POST CONTROLLER-------------------------*/

    // show new post form
	Route::get('new-post','PostController@create')->middleware('auth');
	
	// save new post
	Route::post('new-post','PostController@store')->middleware('auth');
	
	// edit post form
	Route::get('edit/{slug}','PostController@edit')->middleware('auth');
	
	// update post
	Route::post('update','PostController@update')->middleware('auth');

	// delete post
	Route::get('delete/{id}','PostController@destroy')->middleware('auth');

	

	 /*-----------------------------USER CONTROLLER-------------------------*/


	Route::get('my-all-posts','UserController@user_posts_all')->middleware('auth');;
	
	// display user's drafts
	Route::get('my-drafts','UserController@user_posts_draft')->middleware('auth');;

	//users profile
	Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');

	// display list of posts
	Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
	

	 /*-----------------------------COMMENT CONTROLLER-------------------------*/
	
	// add comment
	Route::post('comment/add','CommentController@store');
	
	// delete comment
	Route::post('comment/delete/{id}','CommentController@distroy');


	

	Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);

	/*----------------------------------IMAGES-------------------------------*/


	Route::get('/upload', 'ImageController@getUploadForm');
	Route::post('/upload/image','ImageController@postUpload');


    /*------------------------------SPECIAL----------------*/

    // display single post
	Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');


});
