@extends('layouts.login')

@section('content')
    <div class="search_area top">
        <div class="search_area_box">
            {!! Form::input('text','newPost',null,['required','class'=> 'form-control','placeholder' =>'ユーザー名']) !!}
                <button type="submit"class="post_btn">
                <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                {!! Form::close() !!}
        </div>
    </div>

    <div class="search_area bottom">
        <div class="search_area_results">
            <table class='table'>
                @foreach ($users as $users)
                    <tr>
                        <td><img src=" {{ asset('storage/profiles/'.$users->images) }}" alt="プロフィール画像"></td>
                        <td>{{ $users->username }}</td>

                        <div class="table_btn">
                            <!-- フォロー解除まはたフォローボタン -->
                            <td><button type="button">フォローボタン</button></td>
                        </div>
                        <!-- 繰り返し処理の中に、更新ボタンを追加→投稿の数だけボタンが自動的に作成される
                        URLにパラメータを付与 GET送信-->
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>


@endsection