<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// この後の行でパスを省略するため
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;



class FollowsController extends Controller
{
    //
    public function followList(){
        $followlist = User::query()
        // ユーザテーブルのidが、認証中のユーザに対応するfollowed_idに一致する
        // →(つまり認証中のユーザがフォローしている)ユーザ情報を取得
        // ！！followsメソッドを使う(リレーションを経由して情報を取得する)
        // ※followed_id フォローされた人
        ->whereIn('id', Auth::user()->follows()->pluck('followed_id'))
        ->get();
        // ddd($followlist);
        return view('follows.followList',['followlist'=>$followlist]);
        // ※viewヘルパー:指定したphpファイルを画面に表示する
        // ※【】内は受け渡したいデータ
    }
    public function followerList(){
        $followerlist = User::query()
        // ユーザテーブルのidが、認証中のユーザに対応するfollowing_idに一致する
        // →(つまり認証中のユーザにフォローされている)ユーザ情報を取得
        // ！！followsメソッドを使う(リレーションを経由して情報を取得する)
        // ※following_id フォローした人
         // フォローされているユーザIDから、フォローしているユーザIDにアクセス
        ->whereIn('id', Auth::user()->followers()->pluck('following_id'))
        ->get();
        // ddd($followlist);
        return view('follows.followerList',['followerlist'=>$followerlist]);
        // ※viewヘルパー:指定したphpファイルを画面に表示する
        // ※【】内は受け渡したいデータ
    }

 
}
    /* viewヘルパー:指定したphpファイルを画面に表示する
    followsファイルの中のfollowerList.blade.phpファイルを開く
    C:\Users\yunyu\AtlasSNS\resources\views\follows*/


