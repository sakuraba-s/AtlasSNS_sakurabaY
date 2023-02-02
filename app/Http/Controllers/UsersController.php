<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    //プロフィール画面
    public function profile(){
        return view('users.profile');
    }

    // プロフィール更新
    // バリデーション
    public function validator(array $data){
        $validator=Validator::make($data,[
        'username' => 'required|string|min:2|max:12',
        'mail' => ['required','string','email:filter,dns','min:5','max:40',Rule::unique('users')->ignore(Auth::id())],
        'password' => 'required|string|min:8|max:20|confirmed',
        'password_confirmation' => 'required|string|min:8|max:20',
        'bio' => 'max:150',
        ]);
        return $validator;
    }
    // プロフィール更新メソッド
    // protected function save(array $data)
    // {
    //     return User::save([
    //         'username' => $data['username'],
    //         'mail' => $data['mail'],
    //         'password' => bcrypt($data['password']),
    //     ]);
    // }
    protected function up(Request $request)
    {
        $id = $request->input('id');
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');
        $images = $request->input('images');
         // フォームから渡されたデータの取得
        //  該当のidはフォームよりhiddenで取得する
        User::where('id', $id)->update(
            [
            'username' => $username,
            'mail' => $mail,
            'password' => $password,
            'bio' => $bio,
            'images' => $images,
            ]
            );
            /*
            0⃣モデルPostと接続(＝データベースと接続)
            ⓵postsテーブルのidカラムがフォームから持ってきた$id変数の値と一致するレコードを選択
            ⓶ ⓵で選択したpostカラムの値をup_post変数の値に更新する*/
    }

    // プロフィール更新メソッド全体
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
            // 本コントローラのsaveメソッドを発動
            $this->up($request);
            // usernameを取得、登録後の画面を表示
            $username = $request->input('username');
            return redirect()->route('top')->with('username',$username);
        }
        return view('posts.profile');
        }
    public function search(){
        return view('posts.profile');
    }
}
