@extends('layouts.login')

@section('content')
<div class="container">
    <div class="search_area_box">
        {!! Form::input('text','newPost',null,['required','class'=> 'form-control','placeholder' =>'ユーザー名']) !!}
            <button type="submit"class="post_btn">検索</button>
            {!! Form::close() !!}
    </div>
    <div class="search_area_results">
        <table class='table'>
                <tr>
                    <td>アイコン</td>
                    <td>ユーザー名</td>
                    <div class="table_btn">
                        <!-- フォロー解除まはたフォローボタン -->
                        <td>フォローボタン</td>
                    </div>
                    <!-- 繰り返し処理の中に、更新ボタンを追加→投稿の数だけボタンが自動的に作成される
                    URLにパラメータを付与 GET送信-->
                </tr>
        </table>
    </div>
</div>


@endsection