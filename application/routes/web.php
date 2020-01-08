<?php

Route::get('/', 'welcome@index')->name('homepage');



/* BACKEND ROUTES */
Route::get('/admin/login', 'admin/Authentication@index')->name('admin.login');
Route::get('/admin/logout', 'admin/Authentication@logout')->name('admin.logout');
Route::post('/admin/login', 'admin/Authentication/check_login@index')->name('admin.check_login');

Route::group('admin',['namespace' => 'admin','middleware' => ['CheckIfLogin']], function(){
	Route::get('/', 'dashboard@index')->name('admin.dashboard');

	Route::get('/users/{page?}', 'UserController@index')->name('admin.user.list');
	Route::post('/user-edit/{id?}', 'UserController@submit_form')->name('admin.user.submit_form');
	Route::get('/user-edit/{id?}', 'UserController@edit_form')->name('admin.user.edit_form');
	Route::get('/user-delete/{id}', 'UserController@destory')->name('admin.user.destory');
	Route::post('/user-delete-multiple', 'UserController@destory_multiple')->name('admin.user.destory_multiple');
});


Route::set('404_override', function(){ show_404(); });
Route::set('translate_uri_dashes',FALSE);