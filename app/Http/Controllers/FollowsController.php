<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// この後の行でパスを省略するため


class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
}
    /* viewヘルパー:指定したphpファイルを画面に表示する
    followsファイルの中のfollowerList.blade.phpファイルを開く
    C:\Users\yunyu\AtlasSNS\resources\views\follows*/
