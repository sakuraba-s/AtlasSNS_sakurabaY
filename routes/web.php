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

Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout');

// ユーザ登録
Route::get('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
// ユーザ登録後
Route::get('/added', 'Auth\RegisterController@added')->name('added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ ログイン中のみ閲覧可能
// ミドルウェアのグループ ログイン中のページ
Route::group(['middleware'=>'auth'],function(){
/*認証のルーティング
グループの中に書いたルーティングは、ログイン認証した人だけが使える*/

Route::get('/top','PostsController@index')->name('top');
Route::post('/top','PostsController@index');


Route::get('/profile','UsersController@profile')->name('profile');
Route::get('/edit', 'UsersController@edit')->name('edit');
Route::post('/edit', 'UsersController@edit');
// つぶやき投稿
Route::get('/post', 'PostsController@post')->name('post');
Route::post('/post', 'PostsController@post')->name('post');
// つぶやき編集
Route::post('/post_edit', 'PostsController@edit')->name('edit');

// ユーザー検索
Route::get('/search','UsersController@search')->name('search');
Route::post('/search','UsersController@search')->name('search');
// ユーザ検索 フォロー登録＆解除
Route::post('/users/{id}/follow','UsersController@follow')->name('follow');
Route::delete('/users/{user}/unfollow','UsersController@unfollow')->name('unfollow');

// Route::post('/follow','UsersController@follow')->name('follow');
// Route::post('/unfollow','UsersController@unfollow')->name('unfollow');
// Route::post('/{id}/follow','UsersController@follow')->name('follow');
// Route::post('/{id}/unfollow','UsersController@unfollow')->name('unfollow');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

});

