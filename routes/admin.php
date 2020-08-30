<?php

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    // $exitCode = Artisan::call('config:cache');
});

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::group(['prefix' => 'admin', 'middlewear' => 'auth'], function(){

	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');

	Route::get('password/confirm', 'Admin\ConfirmPasswordController@showConfirmForm')->name('admin.password.confirm');
	Route::post('password/confirm', 'Admin\ConfirmPasswordController@confirm');
	Route::post('password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('password/reset', 'Admin\ResetPasswordController@reset')->name('admin.password.update');
	Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::get('register', 'Admin\RegisterController@showRegistrationForm')->name('admin.register');
	Route::post('register', 'Admin\RegisterController@register');

	// Admins
	Route::get('/panel/admins', ['as' => 'admin.panel.admins' , 'uses' => 'Panel\AdminController@index']);
	Route::get('/panel/admin/listing', ['as' => 'admin.panel.admin.listing' , 'uses' => 'Panel\AdminController@listing']);
	Route::get('/panel/admin/add', ['as' => 'admin.panel.admin.add' , 'uses' => 'Panel\AdminController@add']);
	Route::get('/panel/admin/edit/{admin_id}', ['as' => 'admin.panel.admin.edit' , 'uses' => 'Panel\AdminController@edit']);
	Route::post('/panel/admin/search', ['as' => 'admin.panel.admin.search' , 'uses' => 'Panel\AdminController@search']);
	Route::post('/panel/admin/save', ['as' => 'admin.panel.admin.save' , 'uses' => 'Panel\AdminController@save']);
	Route::post('/panel/admin/delete', ['as' => 'admin.panel.admin.delete' , 'uses' => 'Panel\AdminController@delete']);

	// Admins
	Route::get('/panel/users', ['as' => 'admin.panel.users' , 'uses' => 'Panel\UserController@index']);
	Route::get('/panel/user/listing', ['as' => 'admin.panel.user.listing' , 'uses' => 'Panel\UserController@listing']);
	Route::get('/panel/user/add', ['as' => 'admin.panel.user.add' , 'uses' => 'Panel\UserController@add']);
	Route::get('/panel/user/edit/{user_id}', ['as' => 'admin.panel.user.edit' , 'uses' => 'Panel\UserController@edit']);
	Route::post('/panel/user/search', ['as' => 'admin.panel.user.search' , 'uses' => 'Panel\UserController@search']);
	Route::post('/panel/user/save', ['as' => 'admin.panel.user.save' , 'uses' => 'Panel\UserController@save']);
	Route::post('/panel/user/delete', ['as' => 'admin.panel.user.delete' , 'uses' => 'Panel\UserController@delete']);

	// Roles
	Route::get('/panel/roles', ['as' => 'admin.panel.roles', 'uses' => 'Panel\RoleController@index']);
	Route::get('/panel/role/listing', ['as' => 'admin.panel.role.listing', 'uses' => 'Panel\RoleController@listing']);
	Route::get('/panel/role/add', ['as' => 'admin.panel.role.add', 'uses' => 'Panel\RoleController@add']);
	Route::get('/panel/role/edit/{role_id}', ['as' => 'admin.panel.role.edit', 'uses' => 'Panel\RoleController@edit']);
	Route::post('/panel/role/search', ['as' => 'admin.panel.role.search', 'uses' => 'Panel\RoleController@search']);
	Route::post('/panel/role/save', ['as' => 'admin.panel.role.save', 'uses' => 'Panel\RoleController@save']);
	Route::post('/panel/role/delete', ['as' => 'admin.panel.role.delete', 'uses' => 'Panel\RoleController@delete']);

	// Permissions
	Route::get('/panel/permissions', ['as' => 'admin.panel.permissions', 'uses' => 'Panel\PermissionController@index']);
	Route::get('/panel/permission/listing', ['as' => 'admin.panel.permission.listing', 'uses' => 'Panel\PermissionController@listing']);
	Route::get('/panel/permission/add', ['as' => 'admin.panel.permission.add', 'uses' => 'Panel\PermissionController@add']);
	Route::post('/panel/permission/search', ['as' => 'admin.panel.permission.search', 'uses' => 'Panel\PermissionController@search']);
	Route::post('/panel/permission/save', ['as' => 'admin.panel.permission.save', 'uses' => 'Panel\PermissionController@save']);

	// Settings
     Route::get('/panel/settings', ['as' => 'admin.panel.settings', 'uses' => 'Panel\SettingsController@index']);
     Route::post('/panel/settings', ['as' => 'admin.panel.settings.save', 'uses' => 'Panel\SettingsController@save']);

	// Societies
	Route::get('/panel/socieites', ['as' => 'admin.panel.socieites' , 'uses' => 'Panel\SocietyController@index']);
	Route::get('/panel/society/listing', ['as' => 'admin.panel.society.listing' , 'uses' => 'Panel\SocietyController@listing']);
	Route::get('/panel/society/add', ['as' => 'admin.panel.society.add' , 'uses' => 'Panel\SocietyController@add']);
	Route::get('/panel/society/edit/{society_id}/{page?}', ['as' => 'admin.panel.society.edit' , 'uses' => 'Panel\SocietyController@edit']);
	Route::post('/panel/society/search', ['as' => 'admin.panel.society.search' , 'uses' => 'Panel\SocietyController@search']);
	Route::post('/panel/society/save', ['as' => 'admin.panel.society.save' , 'uses' => 'Panel\SocietyController@save']);
	Route::post('/panel/society/saveBasic', ['as' => 'admin.panel.society.saveBasic' , 'uses' => 'Panel\SocietyController@saveBasic']);
	Route::post('/panel/society/saveLocation', ['as' => 'admin.panel.society.saveLocation' , 'uses' => 'Panel\SocietyController@saveLocation']);
	Route::post('/panel/society/delete', ['as' => 'admin.panel.society.delete' , 'uses' => 'Panel\SocietyController@delete']);
	//get wings of society
	Route::post('/panel/society/wings', ['as' => 'admin.panel.society.wings' , 'uses' => 'Panel\SocietyController@wings']);

	// Wings
	Route::get('/panel/wings', ['as' => 'admin.panel.wings' , 'uses' => 'Panel\WingController@index']);
	Route::get('/panel/wing/listing', ['as' => 'admin.panel.wing.listing' , 'uses' => 'Panel\WingController@listing']);
	Route::get('/panel/wing/add/{society_id?}', ['as' => 'admin.panel.wing.add' , 'uses' => 'Panel\WingController@add']);
	Route::get('/panel/wing/edit/{wing_id}', ['as' => 'admin.panel.wing.edit' , 'uses' => 'Panel\WingController@edit']);
	Route::post('/panel/wing/search', ['as' => 'admin.panel.wing.search' , 'uses' => 'Panel\WingController@search']);
	Route::post('/panel/wing/save', ['as' => 'admin.panel.wing.save' , 'uses' => 'Panel\WingController@save']);
	Route::post('/panel/wing/delete', ['as' => 'admin.panel.wing.delete' , 'uses' => 'Panel\WingController@delete']);

	// Properties
	Route::get('/panel/properties', ['as' => 'admin.panel.properties' , 'uses' => 'Panel\PropertyController@index']);
	Route::get('/panel/property/listing', ['as' => 'admin.panel.property.listing' , 'uses' => 'Panel\PropertyController@listing']);
	Route::get('/panel/property/add/{society_id?}', ['as' => 'admin.panel.property.add' , 'uses' => 'Panel\PropertyController@add']);
	Route::get('/panel/property/edit/{property_id}', ['as' => 'admin.panel.property.edit' , 'uses' => 'Panel\PropertyController@edit']);
	Route::post('/panel/property/search', ['as' => 'admin.panel.property.search' , 'uses' => 'Panel\PropertyController@search']);
	Route::post('/panel/property/save', ['as' => 'admin.panel.property.save' , 'uses' => 'Panel\PropertyController@save']);
	Route::post('/panel/property/delete', ['as' => 'admin.panel.property.delete' , 'uses' => 'Panel\PropertyController@delete']);

	//Society Committee
	Route::get('/panel/societyCommittee', ['as' => 'admin.panel.societyCommittees' , 'uses' => 'Panel\SocietyCommitteeController@index']);
	Route::get('/panel/societyCommittee/listing', ['as' => 'admin.panel.societyCommittee.listing' , 'uses' => 'Panel\SocietyCommitteeController@listing']);
	Route::get('/panel/societyCommittee/add', ['as' => 'admin.panel.societyCommittee.add' , 'uses' => 'Panel\SocietyCommitteeController@add']);
	Route::get('/panel/societyCommittee/edit/{societyCommittee_id}', ['as' => 'admin.panel.societyCommittee.edit' , 'uses' => 'Panel\SocietyCommitteeController@edit']);
	Route::post('/panel/societyCommittee/search', ['as' => 'admin.panel.societyCommittee.search' , 'uses' => 'Panel\SocietyCommitteeController@search']);
	Route::post('/panel/societyCommittee/save', ['as' => 'admin.panel.societyCommittee.save' , 'uses' => 'Panel\SocietyCommitteeController@save']);
	Route::post('/panel/societyCommittee/delete', ['as' => 'admin.panel.societyCommittee.delete' , 'uses' => 'Panel\SocietyCommitteeController@delete']);

});