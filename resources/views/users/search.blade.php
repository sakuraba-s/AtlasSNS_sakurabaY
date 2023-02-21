@extends('layouts.login')

@section('content')
    <div class="search_area top">
        <div class="search_area_box">
        {!! Form::open(['url' => '/search','method'=>'POST']) !!}

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
                            <!--フォロー対象のidを取得する -->
                            <form action="follow" method="post">
                            @csrf
                                <td>
                                    <input type="hidden" name="user_target" value=" $users['id']">
                                    <button type="submit" >フォローする</button>
                                    <input type="hidden" name="user_target" value=" $users['id']">
                                    <button type="submit" >フォロー解除</button>
                                </td>
                            </form>
                        </div>
                        <!-- 繰り返し処理の中に、更新ボタンを追加→投稿の数だけボタンが自動的に作成される
                        URLにパラメータを付与 GET送信-->
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>


@endsection