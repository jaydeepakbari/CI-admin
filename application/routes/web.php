<?php

Route::get('/', 'welcome@index')->name('homepage');



/* BACKEND ROUTES */
Route::get('/admin/login', 'admin/Authentication@index')->name('admin.login');
Route::get('/admin/logout', 'admin/Authentication@logout')->name('admin.logout');
Route::post('/admin/login', 'admin/Authentication@check_login')->name('admin.check_login');
Route::get('/admin/forgot-password', 'admin/Authentication@forget_form')->name('admin.forget_form');
Route::post('/admin/forgot-password', 'admin/Authentication@forget_form_check')->name('admin.forget_form_check');
Route::get('/admin/reset-password/{token}', 'admin/Authentication@reset_password_form')->name('admin.reset_password_form');
Route::post('/admin/reset-password', 'admin/Authentication@reset_password_check')->name('admin.reset_password_check');

Route::group('admin',['namespace' => 'admin','middleware' => ['CheckIfLogin']], function(){
	Route::get('/', 'dashboard@index')->name('admin.dashboard');

	Route::get('/users/{page?}', 'UserController@index')->name('admin.user.list');
	Route::post('/user-edit/{id?}', 'UserController@submit_form')->name('admin.user.submit_form');
	Route::get('/user-edit/{id?}', 'UserController@edit_form')->name('admin.user.edit_form');
	Route::get('/user-delete/{id}', 'UserController@destory')->name('admin.user.destory');
	Route::post('/user-delete-multiple', 'UserController@destory_multiple')->name('admin.user.destory_multiple');

	Route::get('/settings', 'SettingController@index')->name('admin.settings');
	Route::post('/settings', 'SettingController@save_settings')->name('admin.save_settings');

	Route::get('/filemanager/{page?}', 'FilemanagerController@index')->name('admin.filemanager.index');
	Route::post('/filemanager_delete', 'FilemanagerController@delete_photos')->name('admin.filemanager.filemanager_delete');
	Route::post('/filemanager_upload', 'FilemanagerController@upload_photos')->name('admin.filemanager.filemanager_upload');
	Route::post('/filemanager_folder', 'FilemanagerController@folder_create')->name('admin.filemanager.filemanager_folder');
});


Route::set('404_override', function(){ show_404(); });
Route::set('translate_uri_dashes',FALSE);