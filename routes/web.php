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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'Index\StaticPagesController@home');//首页
Route::get('/help', 'Index\StaticPagesController@help')->name('help');//帮助
Route::get('/about', 'Index\StaticPagesController@about')->name('about');//关于我们
Route::get('/signup','Index\UsersController@create')->name('signup');//用户登录
Route::post('/store','Index\UsersController@store')->name('store');//用户注册
Route::resource('users', 'Index\UsersController');//用户信息
