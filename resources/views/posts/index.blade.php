@extends('layouts.login')
    @section('content')

        <div class="post_area top">
            {!! Form::open(['url' => 'post/post']) !!}
                <img src="images/icon1.png">
                {!! Form::input('text','newPost',null,['required','class'=> 'form-control','placeholder' =>'投稿内容を入力してください']) !!}
                <button type="submit"class="post_btn">送信</button>
            {!! Form::close() !!}
        </div>

        <!-- foreachで繰り返す -->
        <div class="posted_area bottom">
            <div class="posted_area--user">
                <img src="images/icon1.png">
            </div>
            <div class="posted_area--content">
                <span>user_id</span>
                <span>post</span>
            </div>
            <div class="posted_area--right">
                <div class="posted_area--time">
                <span>created_at</span>
                </div>
                <div class=posted_area--btn>
                    <td><a class="update_btn" href="post/index"><img src="images/edit.png" alt="編集"></a></td>
                    <td><a class="delete_btn" href="post/index"onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img src="images/trash.png" alt="削除"></a></td>
                </div>
            </div>
            <!-- 編集、削除の際にidをGETで渡す
            編集、削除ボタンは自分の投稿にのみ表示 -->
        </div>
        <!-- endforeachする -->

    @endsection


<!--
この部分全体はid名containerの中に入っている
※login.bladeのほうに記述あり
※さらにside-barと合わせてid名rowに入っている
display: flexで横並びにしている

extends('layouts.login')
Auth認証の読み込み
C:\Users\yunyu\AtlasSNS\resources\views\layoutsフォルダの
login.bladeファイルを継承する

Formの描き方
フォームファザードのinputタグの中身
(type属性の指定、name属性の指定、フォームに初めから入れる値(初期値)の指定、
[その他属性の指定])

※n今回の記述ではewPostは値を取得するためのキーとなるname属性である!!
required 入力必須項目
placeholder 初期値-->



