<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //C:\Users\yunyu\AtlasSNS\resources\views\postsのindex.blade.phpファイルを開く
    public function login(){
        return view('posts.index');
    }
    // トップページを表示する(トップページの前にはログインするようルーティングでミドルウェアしている)
}
