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
                @foreach ($posts as $post)
                <tr>
                <!-- table row -->
                    <td>
                        <!-- table data -->
                        <img src=" {{ asset('storage/profiles/'.$post->user->images) }}" alt="プロフィール画像">
                    </td>
                    <td>
                        <span>{{ $post->user->username }}</span>
                        <span>{{ $post->post }}</span>
                    </td>
                    <td>
                        <!-- 更新時間、編集、削除ボタンエリア -->
                        <div class="posted_area--edit">
                            <span>{{ $post->created_at }}</span>
                            <!-- 投稿内容と投稿のidを渡す
                            ※編集ボタンにpost属性とpost_id属性を追加し、それぞれの投稿内容と投稿idのデータを持たせる
                            ※このボタンが押されたら、、というjQueryを記述するのにわかりやすいよう、クラスを「open」などと設定する-->
                            <!-- <a class="js-modal-open" href="top" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集"></a> -->
                            <!-- トップページを再度読み込む必要はないかなと思った -->
                            <button type="button"class="js-modal-open" data-post="{{ $post->post }}" data-post_id="{{ $post->id }}"><img src="images/edit.png" alt="編集"></button>
                            <!-- <button type="button"class="update_btn"><img src="images/edit.png" alt="編集"></a> -->
                            <!-- 削除ボタン -->
                            <form action="{{ route('post_delete', ['id' => $post->id]) }}" method="POST" onclick="return confirm('このレコードを削除します。よろしいでしょうか？')">
                                        {{ csrf_field() }}
                                        <!-- {{ method_field('DELETE') }} -->
                                        <!-- 削除ボタンを押下→コントローラに 該当のid番号の情報を渡す -->
                                        <button type="submit" ><img src="images/trash.png" alt="削除"></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

            <!-- 編集のダイアログボックス (編集アイコンを押すと現れる)
            押下した投稿内容ただ一つを表示させる-->
        <div class="modal js-modal">
            <!-- ここのbgに対して薄い色をcssで引く -->
            <div class="modal__bg js-modal-close"></div>
                <div class="modal__content">

                    <!-- バリデーションのエラーを表示 -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $errors)
                            <li>{{$errors}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- {!! Form::open(['url' => '/post_edit']) !!}
                        {{ csrf_field() }}
                            {!! Form::input('text','newPost',$post->post,['required','class'=> 'form-control']) !!}
                            <button type="submit"class="update_btn"><img src="images/edit.png" alt="編集"></button>
                            {!!Form::hidden('user_id', '$post->user_id') !!}
                    {!! Form::close() !!} -->
                    <form action="post_edit" method="post">
                        <!-- 取得した投稿内容をモーダルのどこへ渡すかの判別のためにクラス名「modal_post」「modal_id」を設定
                            textareaで枠の右下から入力欄を拡大縮小させることができる-->
                        <!-- <input type="textarea" name="newPost" class="modal_post" value=""> -->
                        <textarea name="newPost" class="modal_post"></textarea>
                        <!-- ※ここの空欄部分valueにiQueryで渡した投稿idが入ってくる -->
                        <input type="hidden" name="id" class="modal_id" value="">
                        <button type="submit"><img src="images/edit.png"  alt="編集" width="30px" height="30px">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
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



