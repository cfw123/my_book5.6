<?php

// 后台路由 一定要在web.php文件中include一下
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['checklogin:admin.login']], function () {

    // 用户登录显示
    Route::get('login', 'LoginController@index')->name('admin.login');
    // 用户登录处理
    Route::post('login', 'LoginController@login')->name('admin.login');

    // 定义后台主页路由
    Route::get('index', 'IndexController@index')->name('admin.index');
    Route::get('welcome', 'IndexController@welcome')->name('admin.welcome');
    // 用户退出
    Route::get('logout', 'IndexController@logout')->name('admin.logout');


    // 分类管理
    Route::resource('category','CategoryController',['as' => 'admin']);
});