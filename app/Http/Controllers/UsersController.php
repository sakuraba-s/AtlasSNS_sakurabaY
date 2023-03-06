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
            $data = $request->input('newPost');
            // 検索ワードに一致するデータを絞り込んで変数に格納する

            $users=\DB::table('users')->where('username', 'like', "%$data%")->get();
            return view('users.search',['users'=>$users]);
            // viewヘルパー:指定したphpファイルを画面に表示する
            // 【】内は受け渡したいデータ
        }
        // ポスト送信されていないとき
        // 全てのユーザの情報を取得
        $users=\DB::table('users')->get();
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

    // フォロー
    // Userモデルを使う
    // 依存性注入 Userをインスタンスして変数userに入れる
    public function follow(User $user)
    {
        // 「フォロワー」の定義
        // 認証中のユーザーがフォロワー側
        $follower = auth()->user();
        // follower変数に対してUserモデルに記載のisFollowingメソッドを呼び出す
        // このときusersテーブルのidを引数として渡す
        // isFollowingは引数として渡したidをフォローしているかどうかが真か偽で返すメソッド
        $is_following = $follower->isFollowing($user->id);

        if(!$is_following) {
            // is_followingが「偽」であるとき(フォローしていなかった時)
            // フォローしていなければフォローする
            $follower->follow($user->id);
            // follower変数に対してUserモデルに記載のisFollowメソッドを呼び出す
            //   followは引数として渡したidをattach(フォロー)する
            return back();
        }
    }
    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }


}
