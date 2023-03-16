<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/*use宣言
ファイルの内で使うクラスや関数や定数などをインポートするために使用
使用したいクラスなどが定義されているファイルのパスを「use パス」の書き方で記述
今回は「Postクラス(Postモデル)」を使用する、という意味
※モデルファイルとはデータベースとのやり取りをするためのファイル*/

class PostsController extends Controller
{
    // 投稿内容のバリデーション
    public function validator(array $data){
        $validator=Validator::make($data,[
        'newPost' => 'required|string|min:1|max:150',
        ]);
        return $validator;
    }
    // postsに必要なデータを取って、ビューに渡す
    public function index(){
        // user_id（誰の投稿か）が認証中のユーザに紐づくフォロー対象のidに一致するものを取得
        // pluckでfollowed_idの値だけを取得できる
        // latest新しい順に
        $posts = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();
        // ddd($posts);
        return view('posts.index')->with([
            'posts' => $posts,
            ]);
    }

    /*新規投稿
    ※処理だけなのでviewファイルはない*/
    public function post(Request $request){
        // ポスト送信されたら
        if($request->isMethod('post')){
            // data変数にinputで送信された値を格納する
            $data = $request->input();
            // dataに対してバリデーションを適用する
            $validator=$this->validator($data);
            // バリデーション失敗したら
                if ($validator->fails()){
                    return redirect('top')
                    ->withErrors($validator)
                    // セッションにエラー情報を入れる
                    ->withInput();
                }
                 // バリデーションに成功したら
                //  認証中のユーザ情報を取得、登録
                $user= Auth::user();
                Post::create([
                    'post' => $request['newPost'],
                    'user_id' => $user->id,
                ]);
                // トップページに戻る
            return redirect('/top');
        };
    }
    // $post =$request -> input('newPost');
    /*index.blade.phpにおいてフォームの送信先が「/post」であり、
    ルーティングでここのコントローラーと繋がる。
    index.blade.phpのinputタグの値をrequest変数に入れる
    その中から「name属性が「newPost」と指定されていたという条件に合致するもの」をpost変数に入れる*/
    /*
    Postモデルとつなげる(＝データベースと繋がる)
    createする*/
    /*テーブルのpostカラムに、$post変数を当てはめる
    posted_areaに投稿が追加される*/

    /*編集*/
    //ポップアップが出る！
    // 投稿内容更新メソッド全体
    public function post_edit(Request $request){
        // ポスト送信されたら
        if($request->isMethod('post')){
            $data = $request->input();
            // ddd($data);
            // 本コントローラのvalidatorメソッドの結果を変数に格納
            // バリデーションを適用
            $validator=$this->validator($data);
                // バリデーション失敗したら
                if ($validator->fails()){
                    return redirect('top')
                    ->withErrors($validator)
                    // セッションにエラー情報を入れる
                    // 入力欄に内容を入れたままにする
                    // ->withInput();
                    ;
                }
                // バリデーションに成功したら
                // 本コントローラのupdateメソッドを発動
                $this->update($request);
                // usernameを取得、登録後の画面を表示
                return redirect()->route('top');
        }
        // ポスト送信されていないときは何も起こらない
        return view('top');
        }
    public function update(Request $request){
        // どの投稿かを取得（hiddenで送信したもの）
        $id = $request->input('id');
        // フォームの入力内容を取得する
        $post = $request->input('newPost');
        Post::where('id', $id)->update([
            'post' => $request['newPost'],
        ]);
        return redirect('/top');
    }
    /*削除*/
    public function post_delete($id){
        Post::where('id', $id)->delete([
        ]);
        return redirect('/top');
    }




    /* メソッドの引数に「POSTからの値を受け取る」$requestを用意
    メソッドインジェクション(依存注入)
    指定した変数に、指定したクラス(Requestクラス)のインスタンスが入る
    Requestクラス:
    アプリケーションが処理している現在のHTTPリクエストを操作し、
    リクエストとともに送信される入力、クッキー、およびファイルを取得するオブジェクト指向の手段を提供
    */
}


