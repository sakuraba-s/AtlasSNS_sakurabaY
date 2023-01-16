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
/*Laravelのウェルカムページ
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');*/

/*認証に関するルーティング！
「route」はphp artisan make:authの実行により勝手に記述される。
routesメソッドはIlluminate\Support\Facades\Authファイルに記述されている*/
Auth::routes();

// ログイン・ログアウト
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');


// ミドルウェアのグループ ログイン中のページ
Route::group(['middleware'=>'auth'],function(){
/*認証のルーティング
グループの中に書いたルーティングは、ログイン認証した人だけが使える*/

// トップページ
Route::get('/top','PostsController@index')->name('top');
Route::post('/top','PostsController@index');

/*post投稿機能のルーティング*/
Route::post('post/post', 'PostsController@post');

// プロフィールページ
Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','PostsController@index');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

});



/*URL、
つなげる先(コントローラーのクラス名PostsController@メソッド名*/

