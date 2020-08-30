<?php

use Illuminate\Support\Facades\Route;

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

// Route::domain('{tenant}.multitenantdemo.local')->middleware('tenant')->group(function () {
// 	Route::get('/', function () {
//         return view('welcome');
//     });
//     Route::get('/home', 'HomeController@index')->name('home');
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middlewear' => 'auth'], function(){
	Route::get('/home', 'HomeController@index')->name('home');
});
