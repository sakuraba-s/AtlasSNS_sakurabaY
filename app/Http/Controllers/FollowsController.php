<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// この後の行でパスを省略するため
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\Auth;



class FollowsController extends Controller
{
    //
    public function followList(){
        // 「認証中のユーザがフォローしているユーザの投稿」を取得したい
        // followsメソッド
        // →フォローしているユーザID(認証中のユーザ)から、フォローされているユーザID(followed_id)にアクセス
        // これ(followed_id)が投稿のid(user_id)に一致すればいい
        // pluckでfollowed_idの値だけを取得できる
        // latest新しい順に
        $followlist = Post::query()
        ->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))
        ->get();
        // ddd($followlist);
        return view('follows.followList',['followlist'=>$followlist]);
        // ※viewヘルパー:指定したphpファイルを画面に表示する
        // ※【】内は受け渡したいデータ
    }
    public function followerList(){
        // 「認証中のユーザのことをフォローしているユーザの投稿」を取得したい
        // followersメソッド
        // →フォローされているユーザID(認証中のユーザ)から、フォローしているユーザID(following_id)にアクセス
        // これ(following_id)が投稿のid(user_id)に一致すればいい
        // pluckでfollowed_idの値だけを取得できる
        // latest新しい順に
        $followerlist = Post::query()
        ->whereIn('user_id', Auth::user()->followers()->pluck('following_id'))
        ->latest()->get();

        return view('follows.followerList',['followerlist'=>$followerlist]);
        // ※viewヘルパー:指定したphpファイルを画面に表示する
        // ※【】内は受け渡したいデータ
    }

 
}
    /* viewヘルパー:指定したphpファイルを画面に表示する
    followsファイルの中のfollowerList.blade.phpファイルを開く
    C:\Users\yunyu\AtlasSNS\resources\views\follows*/


