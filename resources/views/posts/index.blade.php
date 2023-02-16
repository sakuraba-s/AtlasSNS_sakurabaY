@extends('layouts.login')
    @section('content')


        <div class="post_area top">
            {!! Form::open(['url' => '/post']) !!}
                <img src="images/icon1.png">
                {!! Form::input('text','newPost',null,['required','class'=> 'form-control','placeholder' =>'投稿内容を入力してください']) !!}
                <button type="submit"class="post_btn">送信</button>
            {!! Form::close() !!}
        </div>


        <div class="posted_area bottom">
            <!-- 投稿内容を時間系列で？表示 -->
            <!-- foreachで上から順に繰り返す ※postsはuserテーブルと炉レーション済み-->
            <table>
                @foreach ($posts as $posts)
                <tr>
                <!-- table row -->
                    <td>
                        <!-- table data -->
                        <img src=" {{ asset('storage/profiles/'.$posts->user->images) }}" alt="プロフィール画像">
                    </td>
                    <td>
                        <span>{{ $posts->user->username }}</span>
                        <span>{{ $posts->post }}</span>
                    </td>
                    <td>
                        <!-- 更新時間、編集、削除ボタンエリア -->
                        <div class="posted_area--edit">
                            <span>{{ $posts->created_at }}</span>
                            <a class="update_btn" href="post/index"><img src="images/edit.png" alt="編集"></a>
                            <a class="delete_btn" href="post/index"onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img src="images/trash.png" alt="削除"></a>
                        </div>
                    </td>
                    <!-- 編集、削除の際にidをGETで渡す
                    編集、削除ボタンは自分の投稿にのみ表示 -->
                </tr>
                @endforeach
            </table>
        </div>

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



