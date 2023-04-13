<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // すでに認証中の場合にリダイレクトさせるミドルウェア
        // ミドルウェアはKernel.phpに記載あり
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // バリデーション記述原本
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'username' => 'required|string|min:2|max:12',
    //         'mail' => 'required|string|email:filter,dns|min:5|max:40|unique:users',
    //         'password' => 'required|string|min:8|max:20|confirmed',
    //     ]);
    //     if ($validate->fails()) {
    //         return redirect()->route("register")->withErrors($validate->messages());
    //     }
    // }
    // validatorファザードを使用
    // バリデーションに失敗すると自動的にユーザーを以前のページヘリダイレクトする仕様である
    // バリデーションエラーは全部自動的にフラッシュデータとしてセッションへ保存される
        public function validator(array $data){
            $validator=Validator::make($data,[
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email:filter,dns|min:5|max:40|unique:users',
            'password' => 'required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'required|string|min:8|max:20',
            ]);
            return $validator;
        }
            // POSTされてきたデータは、$requestという変数にすべて格納される
            // makeメソッド
            // 第１引数:バリデーションを行うデータ
            // 第２引数:そのデータに適用するバリデーションルール

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // public function registerForm(){
    //     return view("auth.register");
    // }

    // 新規登録 register
    public function register(Request $request){
        if($request->isMethod('post')){
            // データを取得
            $data = $request->input();
            // 本コントローラのvalidatorメソッドの結果を変数に格納
            $validator=$this->validator($data);
                // バリデーション失敗
            if ($validator->fails()){
                return redirect('/register')
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
        return view('auth.register');
        }

    public function added(){
        return view('auth.added');
    }
}

// isMethod() 引数に指定した文字列とHTTP動詞が一致するかを判定する