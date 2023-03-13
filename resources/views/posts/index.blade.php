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
                            <a class="update_btn" href="post/index"><img src="images/edit.png" alt="編集"></a>
                            <a class="delete_btn" href="post/index"onclick="return confirm('この投稿を削除します。よろしいでしょうか？')"><img src="images/trash.png" alt="削除"></a>
                        </div>
                    </td>
                    <!-- 編集、削除の際にidをGETで渡す
                    編集、削除ボタンは自分の投稿にのみ表示 -->

                    <!-- 編集のダイアログボックス -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">確認画面</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route' => 'process', 'method' => 'POST']) !!}
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <p class="col-sm-4 col-form-label">お名前（全角10文字以内）<span class="badge badge-danger ml-1">必須</span></p>
                                <div class="col-sm-8">
                                    <p class="modal-name"></p>
                                    <input class="modal-name" type="hidden" name="name" value="">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <p class="col-sm-4 col-form-label">メールアドレス<span class="badge badge-danger ml-1">必須</span></p>
                                <div class="col-sm-8">
                                    <p class="modal-email"></p>
                                    <input class="modal-email" type="hidden" name="email" value="">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <p class="col-sm-4 col-form-label">電話番号</p>
                                <div class="col-sm-8">
                                    <p class="modal-tel"></p>
                                    <input class="modal-tel" type="hidden" name="tel" value="">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <p class="col-sm-4 col-form-label">性別<span class="badge badge-danger ml-1">必須</span></p>
                                <div class="col-sm-8">
                                    <p class="modal-gender"></p>
                                    <input class="modal-gender" type="hidden" name="gender" value="">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <p class="col-sm-4 col-form-label">選択（複数選択可）<span class="badge badge-danger ml-1">必須</span></p>
                                <div class="col-sm-8">
                                    <p class="modal-checkbox"></p>
                                    <input class="modal-checkbox" type="hidden" name="checkbox" value="">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <p class="col-sm-4 col-form-label">お問い合わせ内容<span class="badge badge-danger ml-1">必須</span></p>
                                <div class="col-sm-8">
                                    <p class="modal-contents"></p>
                                    <input class="modal-contents" type="hidden" name="contents" value="">
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">修正する</button>
                                {{ Form::submit('送信', ['name' => 'submit', 'class' => 'btn btn-primary']) }}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    <!-- 編集ダイアログボックス終わり -->





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



