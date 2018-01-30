<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
	'uses' => 'FrontEndController@index',
	'as' => 'main.page'
]);

Route::get('/post/{slug}', [
	'uses' => 'FrontEndController@single_post',
	'as' => 'main.single-post'
]);

Route::get('/category/{id}', [
	'uses' => 'FrontEndController@category_page',
	'as' => 'main.category'
])->where('id', '[0-9]+');

Route::get('/tag/{id}', [
	'uses' => 'FrontEndController@tag_page',
	'as' => 'main.tag'
])->where('id', '[0-9]+');

Route::post('/search', [
	'uses' => 'FrontEndController@search_page',
	'as' => 'main.search'
]);

Auth::routes();


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

	Route::get('/home', [
		'uses' 	=> 'HomeController@index',
		'as' 	=> 'home'
	]);

	// Posts http request
	
	Route::get('/post', [
		'uses' 	=> 'PostsController@index',
		'as' 	=> 'post.index'
	]);

	Route::get('/post/create', [
		'uses' 	=> 'PostsController@create',
		'as' 	=> 'post.create'
	]);

	Route::get('/post/trashed', [
		'uses' 	=> 'PostsController@trashed',
		'as' 	=> 'post.trashed'
	]);

	Route::get('/post/trash/{id}', [
		'uses' 	=> 'PostsController@trash',
		'as' 	=> 'post.trash'
	]);

	Route::get('/post/restore/{id}', [
		'uses' 	=> 'PostsController@restore',
		'as' 	=> 'post.restore'
	]);

	Route::post('/post/store', [
		'uses' 	=> 'PostsController@store',
		'as' 	=> 'post.store'
	]);

	Route::get('/post/edit/{id}', [
		'uses' 	=> 'PostsController@edit',
		'as' 	=> 'post.edit'
	])->where('id', '[0-9]+');

	Route::post('/post/update/{id}', [
		'uses' 	=> 'PostsController@update',
		'as' 	=> 'post.update'
	])->where('id', '[0-9]+');

	Route::get('/post/delete/{id}', [
		'uses' 	=> 'PostsController@destroy',
		'as' 	=> 'post.delete'
	])->where('id', '[0-9]+');

	// End posts http request

	// Categories http request
	Route::get('/category/create', [
		'uses' 	=> 'CategoriesController@create',
		'as' 	=> 'category.create'
	]);

	Route::get('/category/categories', [
		'uses' 	=> 'CategoriesController@index',
		'as' 	=> 'category.index'
	]);

	Route::get('/category/edit/{id}', [
		'uses' 	=> 'CategoriesController@edit',
		'as' 	=> 'category.edit'
	])->where('id', '[0-9]+');

	Route::get('/category/delete/{id}', [
		'uses' 	=> 'CategoriesController@destroy',
		'as' 	=> 'category.delete'
	])->where('id', '[0-9]+');

	Route::post('/category/store', [
		'uses' 	=> 'CategoriesController@store',
		'as' 	=> 'category.store'
	]);

	Route::post('/category/update/{id}', [
		'uses' 	=> 'CategoriesController@update',
		'as' 	=> 'category.update'
	]);

	// End categories http request
	 
	
	// Tag http request
	
	Route::get('/tags', [
		'uses' 	=> 'TagsController@index',
		'as' 	=> 'tags.index'
	]);

	Route::get('/tag/edit/{id}', [
		'uses' 	=> 'TagsController@edit',
		'as' 	=> 'tags.edit'
	])->where('id', '[0-9]+');

	Route::get('/tag/delete/{id}', [
		'uses' 	=> 'TagsController@destroy',
		'as' 	=> 'tags.delete'
	])->where('id', '[0-9]+');

	Route::get('/tag/create', [
		'uses' 	=> 'TagsController@create',
		'as' 	=> 'tags.create'
	]);

	Route::post('/tag/update/{id}', [
		'uses' 	=> 'TagsController@update',
		'as' 	=> 'tags.update'
	])->where('id', '[0-9]+');

	Route::post('/tag/store', [
		'uses' 	=> 'TagsController@store',
		'as' 	=> 'tags.store'
	]);


	// End tag http request


	// Users http request
	
	Route::get('/users', [
		'uses' 	=> 'UsersController@index',
		'as' 	=> 'users.index'
	]);

	Route::get('/users/create', [
		'uses' 	=> 'UsersController@create',
		'as' 	=> 'users.create'
	]);

	Route::get('/users/setadmin/{id}', [
		'uses' 	=> 'UsersController@set_admin_permission',
		'as' 	=> 'users.setadmin'
	])->where('id','[0-9]+');

	Route::get('/users/removeadmin/{id}', [
		'uses' 	=> 'UsersController@remove_admin_permission',
		'as' 	=> 'users.removeadmin'
	])->where('id', '[0-9]+');

	Route::get('/users/profile', [
		'uses' 	=> 'ProfilesController@index',
		'as' 	=> 'users.profile'
	]);

	Route::get('/users/delete/{id}', [
		'uses' 	=> 'UsersController@destroy',
		'as' 	=> 'users.delete'
	]);

	Route::post('/users/profile/update', [
		'uses' 	=> 'ProfilesController@update',
		'as' 	=> 'users.profile.update'
	]);

	Route::post('/users/store', [
		'uses' 	=> 'UsersController@store',
		'as' 	=> 'users.store'
	])->where('id', '[0-9]+');

	Route::post('/users/edit/{id}', [
		'uses' 	=> 'UsersController@edit',
		'as' 	=> 'users.edit'
	])->where('id', '[0-9]+');

	Route::post('/users/update/{id}', [
		'uses' 	=> 'UsersController@update',
		'as' 	=> 'users.update'
	])->where('id', '[0-9]+');

	// End user http request 
	

	// Settings http request
	Route::get('/settings', [
		'uses' 	=> 'SettingsController@index',
		'as' 	=> 'settings'
	]);

	Route::post('/settings/update/{id}', [
		'uses' 	=> 'SettingsController@update',
		'as' 	=> 'settings.update'
	]);
	// End user http request
});



