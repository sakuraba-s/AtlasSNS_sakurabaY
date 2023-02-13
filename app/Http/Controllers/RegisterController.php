<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function update(Request $request){
        if($request->isMethod('post')){
            // データを取得
            $data = $request->input();
            // 本コントローラのvalidatorメソッドの結果を変数に格納
            $validator=$this->validator($data);
                // バリデーション失敗
            if ($validator->fails()){
                return redirect('/profile')
                ->withErrors($validator)
                // セッションにエラー情報を入れる
                ->withInput();
            }
            // バリデーション成功
            // 本コントローラのcreateメソッドを発動
            $this->create($data);
            // usernameを取得、登録後の画面を表示
            $username = $request->input('username');
            return redirect()->route('added')->with('username',$username);
        }
        return view('posts.index');
        }
        // ？？？このファイルって要るんだっけ？(;'∀')
}


