<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;

/*use宣言
ファイルの内で使うクラスや関数や定数などをインポートするために使用
使用したいクラスなどが定義されているファイルのパスを「use パス」の書き方で記述
今回は「Postクラス(Postモデル)」を使用する、という意味
※モデルファイルとはデータベースとのやり取りをするためのファイル*/

class PostsController extends Controller
{


    /*indexメソッド(トップページ)*/
    public function index(){
        $posts=Post::with(['user'])->get();
        // リレーション元を取得
        // with()の中にはModelsで作ったメソッド名を入れる。
        return view('posts.index',[
            'posts'=>$posts,
            ]);
        /* viewヘルパー:指定したphpファイルを画面に表示する
        【】内は受け渡したいデータ*/
    }


    /*postメソッド(postのページ)
    ※処理だけなのでviewファイルはない*/
    public function post(Request $request){
        $user= Auth::user();
        // $post =$request -> input('newPost');
        /*index.blade.phpにおいてフォームの送信先が「/post」であり、
        ルーティングでここのコントローラーと繋がる。
        index.blade.phpのinputタグの値をrequest変数に入れる
        その中から「name属性が「newPost」と指定されていたという条件に合致するもの」をpost変数に入れる*/
        Post::create([
            'post' => $request['newPost'],
            'user_id' => $user->id,
        ]);
        /*
        Postモデルとつなげる(＝データベースと繋がる)
        createする*/

        /*テーブルのpostカラムに、$post変数を当てはめる
        posted_areaに投稿が追加される*/
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


