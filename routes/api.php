<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 标识 /api/版本号/地址
Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {

    //分类
    Route::get('/category', 'BookController@toCategory');//view
    Route::get('/category/parent_id/{parent_id}', 'BookController@getCategoryByParentId');

    //产品
    Route::get('/product/category_id/{category_id}', 'BookController@toProduct'); //view
    Route::get('/product/{product_id}', 'BookController@toPdtContent'); //view

    // 购物车
    Route::get('cart/add/{product_id}', 'CartController@addCart');
    Route::get('cart/delete', 'CartController@deleteCart');

//    Route::get('/cart', 'CartController@toCart'); //view
    Route::match(['get', 'post'], '/order_commit', 'OrderController@toOrderCommit')->middleware(['check.cart', 'check.weixin']);
//    Route::match(['get', 'post'], '/order_commit', 'OrderController@toOrderCommit');
    Route::get('/order_list', 'OrderController@toOrderList')->middleware(['mem.login']);
//    Route::get('/order_list', 'OrderController@toOrderList');


    // 用户列表
    Route::get('validate_code/create', 'ValidateController@create');
    Route::get('validate_email', 'ValidateController@validateEmail');
    Route::post('validate_phone/send', 'ValidateController@sendSMS');

    Route::post('/register', 'MemberController@register');
    Route::post('/login', 'MemberController@login');

    Route::get('login', 'MemberController@toLogin');
    Route::get('register', 'MemberController@toRegister');

});
