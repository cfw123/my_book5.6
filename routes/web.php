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
Route::get('cache','MyCacheController@index');
Route::get('/', function () {
return 'hello';
});
Route::get('/home', function () {
//    echo phpinfo();
//    exit();
    return view('home');
});

include base_path('routes/admin/admin.php');


