<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    // プロフィール更新
    public function validator(array $data){
        $validator=Validator::make($data,[
        'username' => 'required|string|min:2|max:12',
        'mail' => 'required|string|email:filter,dns|min:5|max:40|unique:users',
        'password' => 'required|string|min:8|max:20|confirmed',
        'password_confirmation' => 'required|string|min:8|max:20',
        ]);
        return $validator;
    }
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
            // バリデーション
            // 本コントローラのcreateメソッドを発動
            $this->create($data);
            // usernameを取得、登録後の画面を表示
            $username = $request->input('username');
            return redirect()->route('added')->with('username',$username);
        }
        return view('posts.index');
        }
    public function search(){
        return view('users.search');
    }
}
