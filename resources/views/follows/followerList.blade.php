@extends('layouts.login')

@section('content')
<div class="content">
    <div class="followerlist_icon">
    @foreach ($followerlist as $followerlist)
    <img src=" {{ asset('storage/profiles/'.$followerlist->images) }}" alt="プロフィール画像">
    @endforeach


    </div>
    <div class="followlist_table">
        <table class='table'>
                <tr>
                    <td>アイコン</td>
                    <td>ユーザー名</td>
                    <td>投稿内容</td>
                    <td>投稿時間</td>
                    <!-- 繰り返し処理の中に、更新ボタンを追加→投稿の数だけボタンが自動的に作成される
                    URLにパラメータを付与 GET送信-->
                </tr>
        </table>
    </div>
</div>
@endsection