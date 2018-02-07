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


Route::get('/MP_verify_u8o0o6vDsLXCjpty.txt', function () {
    return response()->download(realpath(base_path('app')) . '/files/MP_verify_u8o0o6vDsLXCjpty.txt', 'MP_verify_u8o0o6vDsLXCjpty.txt');
});

Route::get('/wxPage', 'Web\IndexController@wxPage');       //微信授权

//登录

Route::group(['prefix' => '', 'middleware' => []], function () {

    //首页
    Route::get('/index', 'Web\IndexController@index');       //首页
    //web登录回调
    Route::any('/webLogin', 'Web\IndexController@webLogin');       //首页

});