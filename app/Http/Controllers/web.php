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
/*Laravelのウェルカムページ*/
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();


//ログアウト中のページ
Route::group(['middleware'=>'auth'],function(){
/*認証のルーティング
グループの中に書いたルーティングは、ログイン認証した人だけが使える*/
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');
});



//ログイン中のページ
// トップページ
Route::get('/top','PostsController@index');
/*post投稿機能のルーティング*/
Route::post('post/post', 'PostsController@post');

// プロフィールページ
Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','PostsController@index');

/*URL、
つなげる先(コントローラーのクラス名PostsController@メソッド名*/

