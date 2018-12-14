<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// 認證路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 註冊路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => 'auth'], function () {
    Route::get('auth/{year}/dashboard', ['as' => 'dashboard','uses' => 'Auth\DashboardController@index'])->where('year', '[0-9]+');
    Route::get('auth/dashboard', ['as' => 'index','uses' => 'Auth\DashboardController@index']);
    Route::get('auth/clean/cache', 'Auth\DashboardController@cache');

    Route::get('auth/{year}/fair/create', 'Auth\FairController@index')->where('year', '[0-9]+');
    Route::get('auth/{year}/active', 'Auth\FairController@active')->where('year', '[0-9]+');

    Route::get('auth/{year}/post', ['as'=>'post', 'uses' =>'Auth\PostController@index'])->where('year', '[0-9]+');
    Route::get('auth/{year}/post/{id}',['as'=>'post-edit','uses'=> 'Auth\PostController@edit'])->where(['year'=>'[0-9]+','id'=>'[0-9]+']);
    Route::post('auth/{year}/post/{id}/update', 'Auth\PostController@update')->where(['year'=>'[0-9]+','id'=>'[0-9]+']);

    Route::get('auth/{year}/post/create', 'Auth\PostController@create')->where('year', '[0-9]+');
    Route::post('auth/{year}/post/create', 'Auth\PostController@store')->where('year', '[0-9]+');
    Route::post('auth/post/delete/{id}', ['as'=>'post-delete', 'uses' =>'Auth\PostController@delete'])->where('id', '[0-9]+');
    Route::post('auth/post/status/{id}', ['as'=>'post-status' , 'uses' => 'Auth\PostController@status'])->where('id', '[0-9]+');

    Route::post('auth/fair/create', 'Auth\FairController@store');
    Route::post('auth/fair/update', 'Auth\FairController@update');
    Route::post('auth/fair/set', 'Auth\FairController@set');
    Route::get('auth/file/search', 'Auth\FileController@search');
    Route::get('auth/file', 'Auth\FileController@index');
    Route::get('auth/file/load', 'Auth\FileController@load');
    Route::get('auth/file/image', 'Auth\FileController@image');
    Route::get('auth/file/images/{start}', 'Auth\FileController@images')->where('start', '[0-9]+');
    Route::get('auth/file/doc', 'Auth\FileController@doc');
    Route::get('auth/file/docs/{start}', 'Auth\FileController@docs')->where('start', '[0-9]+');
    Route::get('auth/file/other', 'Auth\FileController@other');
    Route::post('auth/file/delete', 'Auth\FileController@destroy');
    Route::get('auth/link', ['as'=>'link', 'uses' =>'Auth\LinkController@index']);
    Route::post('auth/link/delete/{id}', ['as'=>'link-delete', 'uses' =>'Auth\LinkController@destroy'])->where('id', '[0-9]+');
    Route::get('auth/link/{id}',['as'=>'link-edit','uses'=> 'Auth\LinkController@edit'])->where('id','[0-9]+');
    Route::get('auth/link/create', 'Auth\LinkController@create');
    Route::post('auth/link/create', 'Auth\LinkController@store');
    Route::post('auth/link/update/{id}', 'Auth\LinkController@update')->where('id','[0-9]+');

    Route::get('auth/{year}/partner' , ['as'=>'partner', 'uses' =>'Auth\PartnerController@index'])->where('year', '[0-9]+');
    Route::post('auth/partner/delete/{id}', ['as'=>'partner-delete', 'uses' =>'Auth\PartnerController@destroy'])->where('id', '[0-9]+');
    Route::get('auth/partner/{id}',['as'=>'partner-edit','uses'=> 'Auth\PartnerController@edit'])->where('id','[0-9]+');
    Route::get('auth/partner/create', 'Auth\PartnerController@create');
    Route::post('auth/partner/create', 'Auth\PartnerController@store');
    Route::post('auth/partner/update/{id}', 'Auth\PartnerController@update')->where('id','[0-9]+');
    Route::post('auth/partner/status/{id}', ['as'=>'partner-status' , 'uses' => 'Auth\PartnerController@status'])->where('id', '[0-9]+');


    Route::get('auth/{year}/lecture', ['as'=>'lecture', 'uses' =>'Auth\LectureController@index'])->where('year', '[0-9]+');
    Route::get('auth/{year}/lecture/order/{type}', 'Auth\LectureController@order')->where(['year'=> '[0-9]+', 'type'=> '[a-zA-Z]+']);
    Route::post('auth/{year}/lecture', 'Auth\LectureController@store')->where('year', '[0-9]+');
    Route::get('auth/{year}/lecture/create', 'Auth\LectureController@create')->where('year', '[0-9]+');
    Route::post('auth/{year}/lecture/create', 'Auth\LectureController@store')->where('year', '[0-9]+');
    Route::post('auth/lecture/delete/{id}', ['as'=>'lecture-delete', 'uses' =>'Auth\LectureController@delete'])->where('id', '[0-9]+');
    Route::get('auth/{year}/lecture/{id}',['as'=>'lecture-edit','uses'=> 'Auth\LectureController@edit'])->where(['year'=>'[0-9]+','id'=>'[0-9]+']);
    Route::post('auth/{year}/lecture/{id}/update', 'Auth\LectureController@update')->where(['year'=>'[0-9]+','id'=>'[0-9]+']);
//    Category
    Route::get('auth/category', 'Auth\CategoryController@index');
    Route::post('auth/category', 'Auth\CategoryController@store');
    Route::post('auth/category/delete/{id}', 'Auth\CategoryController@delete')->where('id','[0-9]+');
    Route::post('auth/category/update/{id}', 'Auth\CategoryController@update')->where('id','[0-9]+');

    Route::post('auth/upload', 'Auth\FileController@upload');
    Route::post('auth/uploadMultiple', 'Auth\FileController@uploadMultiple');
});

Route::get('/{year?}', 'FairController@index')->where('year', '[0-9]+');
//Route::get('/{year}/lecture',['as'=>'lecture-ajax','uses'=> 'FairController@lecturebyyear'])->where(['year'=>'[0-9]+']);
Route::get('/{year}/lecture/{type}', 'FairController@lecturebytype');
Route::post('/deploy', 'DeployController@index');
Route::post('/contact', 'ContactController@get');




Route::get('/', function () {
    return view('welcome');
});

Route::get('shit', function () {
    return "SHIT SHIT";
});
