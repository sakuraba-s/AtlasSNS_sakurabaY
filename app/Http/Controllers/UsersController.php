<?php

namespace App\Http\Controllers;
use App\User;
use App\Follow;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;



class UsersController extends Controller
{
    //プロフィール画面
    public function profile(){
        return view('users.profile');
    }
    //プロフィール画面(相手)
    public function othersprofile($id){
        // ルートパラメータで渡した値がアクションメソッドの引数に渡されるので、それをそのまま利用する
        // フォームの入力内容を取得する
        // 押下したユーザidに一致するデータをpostsテーブルから持ってくる
        $otheruser=Post::where('user_id', $id)
        ->get();
        // ddd($id);
        // ddd($otheruser);
        // echo($otheruser);
        return view('users/othersprofile',['otheruser'=>$otheruser]);
            // ※viewヘルパー:指定したphpファイルを画面に表示する
            // ※【】内は受け渡したいデータ
    }

    // プロフィール更新
    // バリデーション
    public function validator(array $data){
        $validator=Validator::make($data,[
        'username' => 'required|string|min:2|max:12',
        'mail' => ['required','string','email:filter,dns','min:5','max:40',Rule::unique('users')->ignore(Auth::id())],
        'password' => 'required|string|min:8|max:20|confirmed',
        // 'password_confirmation' => 'required|string|min:8|max:20',
        'bio' => 'max:150',
        ]);
        return $validator;
    }

    // プロフィール更新部分
    protected function update(Request $request)
    {
        // フォームの入力内容を取得する
        $id = $request->input('id');
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = Hash::make($request->input('password'));
        $bio = $request->input('bio');


        // 画像のアップロードがあったとき
        if (is_uploaded_file($_FILES['images']['tmp_name'])){
            // アップロードされた画像を保存する
            // ディレクトリ名
            $dir = 'profiles';
            // アップロードされたファイル名を取得
            $images = $request->file('images')->getClientOriginalName();
            // storageディレクトリに画像を保存
            $request->file('images')->storeAs('public/' . $dir,$images);

            //  該当のidはフォームよりhiddenで取得する
            // どのidのユーザー情報を更新するのかを指定する
            User::where('id', $id)->update(
            [
            'username' => $username,
            'mail' => $mail,
            'password' => $password,
            'bio' => $bio,
            'images' => $images,
            ]
            );
        }else{
            // 画像のアップロードがない場合
            User::where('id', $id)->update(
                [
                'username' => $username,
                'mail' => $mail,
                'password' => $password,
                'bio' => $bio,
                ]
            );
        }
            /*
            0⃣モデルPostと接続(＝データベースと接続)
            ⓵postsテーブルのidカラムがフォームから持ってきた$id変数の値と一致するレコードを選択
            ⓶ ⓵で選択したpostカラムの値をup_post変数の値に更新する*/
    }

    // プロフィール更新メソッド全体
    public function edit(Request $request){
        // ポスト送信されたら
        if($request->isMethod('post')){
            $data = $request->input();
            // 本コントローラのvalidatorメソッドの結果を変数に格納
            $validator=$this->validator($data);
                // バリデーション失敗したら
                if ($validator->fails()){
                    return redirect('/profile')
                    ->withErrors($validator)
                    // セッションにエラー情報を入れる
                    ->withInput();
                }
                // バリデーションに成功したら
                // 本コントローラのsaveメソッドを発動
                $this->update($request);
                // usernameを取得、登録後の画面を表示
                $username = $request->input('username');
                return redirect()->route('top')->with('username',$username);
        }
        // ポスト送信されていないとき
        return view('posts.profile');
        }


    //ユーザ検索画面search
    public function search(Request $request){
        // ポスト送信（検索ワードの入力）があったら
        if($request->isMethod('post')){
            // 入力された文字を取得
            $search_word = $request->input('newPost');
            // 検索ワードに一致するユーザのデータを絞り込む
            $users=\DB::table('users')->where('username', 'like', "%$search_word%")->get();
            // 絞り込んだ結果をビューに受け渡す
            return view('users.search',['users'=>$users],['search_word'=>$search_word]);
            // ※viewヘルパー:指定したphpファイルを画面に表示する
            // ※【】内は受け渡したいデータ
        }
        // ポスト送信されていないとき
        // 自分以外の全てのユーザの情報を取得
        $users=\DB::table('users')
        ->Where('id','!=', Auth::user()->id)
        ->get();
        return view('users.search',['users'=>$users]);
    }

    // public function follow(Request $request){
        /* followsテーブルの「following_id」がログインユーザーである中の
        followed_id」を確認する
        name送信されたidがあれば削除(フォロー解除)、なければ登録(フォローする)*/

        // // ボタンを押下した行のユーザidを取得
        // $user_target=$request->input('user_target');
        // // ログインユーザのidを取得
        // $user=Auth::user()->id;
        // // followsテーブルの「following_id」がログインユーザーであり、
        // // かつ 「followed_id」がボタンを押した行のユーザidに合致するデータを取得する
        // $follows=\DB::table('follows')
        // ->where('following_id', $user)
        // ->where('followed_id', $user_target)
        // ->get();
        // var_dump(empty($follows));
        // dd($follows);

        // if(false){
        // if($follows){
        //     // フォロー中であれば解除(フォローデーブルから削除)
        //     follow::where('followed_id', "$user_target")->delete();
        //     // dd($user_target);
        //     return redirect()->route('search');
        // }
        // フォローされていないユーザーであればフォローテーブルに登録
    //     $this->register($user,$user_target);
    //     return redirect()->route('search');
    // }

    // フォローテーブルへの登録
    // public function register($user,$user_target)
    // {
    //     return Follow::create([
    //         'following_id' => $user,
    //         'followed_id' => $user_target,
    //     ]);
    // }

    // フォローボタンの中身
    // フォローしていなかった場合、フォローするボタン
    // ビュー側で渡したidを引数にセットする★
    public function follow($id)
    {
        // 認証中のユーザーが「フォローする側」
        $follower = Auth::user();
        // フォローする
        $follower->follow($id);
        // follower変数に対してUserモデルに記載のisFollowメソッドを呼び出す
        //   followは引数として渡したidをattach(フォロー)する
        // 元居たページへリダイレクト
        return back();
    }
    // フォロー解除
    // フォローしていた場合、フォロー解除するボタン
    public function unfollow($id)
    {
        $follower = Auth::user();
            // フォローを解除する
            $follower->unfollow($id);
            // follower変数に対してUserモデルに記載のunFollowメソッドを呼び出す
            //   unfollowは引数として渡したidをdetach(フォロー解除)する
            // return redirect('/search');
            // 元居たページへリダイレクト
            return back();
        }
    // }

}
