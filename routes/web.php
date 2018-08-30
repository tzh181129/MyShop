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

Route::get('test','FollowController@test');

//注册登录
Route::get('register','RegisterController@register');
Route::post('register','RegisterController@registerpost');
Route::get('code/{tmp}','CodeController@code');
Route::get('login','LoginController@login');
Route::post('login','LoginController@loginpost');
Route::get('loginout','LoginController@loginout');

Route::get('shop','ProductsController@shop');
Route::get('descend','ProductsController@descend');
Route::get('screen','ProductsController@screen');
Route::post('screen','ProductsController@screenpost');
Route::get('recommend','ProductsController@recommend');

Route::get('update','LoginController@update');
Route::post('update','LoginController@updatepost');
Route::get('release','BusinessController@release');
Route::post('release','BusinessController@releasepost');
Route::post('shopsearch','BusinessController@shopsearch');
Route::get('product','ProductsController@product');
Route::post('product','ProductsController@productpost');
Route::post('search','ProductsController@search');
Route::get('cart','ProductsController@cart');
Route::get('getcart','ProductsController@getcart');
Route::get('cartcount','ProductsController@cartcount');
Route::get('delete','ProductsController@delete');
Route::post('alldel','ProductsController@alldel');
Route::get('home','ProductsController@home');
//店铺
Route::get('business','BusinessController@business');
Route::post('business','BusinessController@businesspost');
Route::get('businesshome','BusinessController@businesshome');
Route::get('information','LoginController@information');
Route::get('released','ProductsController@released');
Route::get('myshop','BusinessController@myshop');
Route::get('shopshow','BusinessController@shopshow');
//订单
Route::post('orderpost','OrderController@orderpost');
Route::get('allorder','OrderController@allorder');
Route::get('order','OrderController@order');
Route::post('myorder','OrderController@myorder');
Route::post('form','OrderController@form');
Route::get('unshipped','OrderController@unshipped');
Route::get('already','OrderController@already');
Route::get('orderfinish','OrderController@orderfinish');
Route::get('shoporder','OrderController@shoporder');
Route::post('shoporder','OrderController@shoporderpost');
Route::get('delivery','OrderController@delivery');
Route::get('shopalready','OrderController@shopalready');
Route::get('shopfinish','OrderController@shopfinish');
Route::get('orderdel', 'OrderController@orderdel');
//评价
Route::get('evaluate','EvaluateController@evaluate');
Route::post('evaluate','EvaluateController@evaluatepost');
Route::get('evaluateshow','EvaluateController@evaluateshow');
Route::get('evaluatedel', 'EvaluateController@evaluatedel');
Route::get('review','EvaluateController@review');
Route::post('review','EvaluateController@reviewpost');

//收藏
Route::post('collectionpost','CollectionController@collectionpost');
Route::get('collection','CollectionController@collection');
Route::get('collectiondelete', 'CollectionController@collectiondelete')->where('id','[0-9]{1,3}');
//关注
Route::get('follow','FollowController@follow');
Route::get('myfollow','FollowController@myfollow');
Route::get('followdelete', 'FollowController@followdelete');

