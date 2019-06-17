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
Route::get('/', 'Index\StaticPagesController@home')->name('home');//首页
Route::get('/help', 'Index\StaticPagesController@help')->name('help');//帮助
Route::get('/about', 'Index\StaticPagesController@about')->name('about');//关于我们
Route::get('/signup','Index\UsersController@create')->name('users.signup');//用户登录
Route::post('/store','Index\UsersController@store')->name('users.store');//用户注册
Route::get('/index','Index\UsersController@index')->name('users.index');//用户注册
Route::resource('users', 'Index\UsersController');//用户信息
Route::get('/login', 'Index\LoginController@create')->name('users.login');//用户登录
Route::post('/login', 'Index\LoginController@store')->name('users.login');//用户登录
Route::delete('/logout', 'Index\LoginController@logout')->name('logout');//用户退出
Route::get('/signup/confirm/{token}','Index\UsersController@confirmEmail')->name('users.confirmEmail');//用户注册
Route::resource('/statuses','Index\StatusesController', ['only' => ['store', 'destroy']]);//文章创建和删除
