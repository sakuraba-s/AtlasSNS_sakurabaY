@extends('layouts.login')

@section('content')

    <div class="search_top top">
        <div class="search_box">
            <!-- 検索窓エリア -->
            {!! Form::open(['url' => '/search','method'=>'POST']) !!}

                {!! Form::input('text','newPost',null,['required','class'=> 'form-control','placeholder' =>'ユーザー名']) !!}
                <button type="submit"class="search_btn btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            {!! Form::close() !!}
            <!-- 検索ワード表示 Usersコントローラから$search_wordの受け渡しがあった場合に表示する-->
            @if(isset($search_word))
            <p>検索ワード：{{$search_word}}</p>
            @endif

        </div>
    </div>

    <div class="search_bottom bottom">
        <div class="search_results">
            <table class='table'>
                <!-- ※この↓usersはUsersコントローラで取得したユーザのデータ -->
                @foreach ($users as $user)
                    <tr>
                        <td><img src=" {{ asset('storage/profiles/'.$user->images) }}" class="pro_img" alt="プロフィール画像"></td>
                        <td>{{ $user->username }}</td>

                        <div class="table_btn">
                            <td>
                                <!-- フォロー解除まはたフォローボタン -->
                                <!-- UserモデルのisFollowingメソッドの結果が真ならば(すでにフォローしているならば)
                                フォローを解除する。この時、解除するメソッドに解除対象のユーザーのidを渡す-->
                                @if (auth()->user()->isFollowing($user->id))
                                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="unfollow_btn btn" ><a>フォロー解除</a></button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="follow_btn btn"><a>フォローする</a></button>
                                    </form>
                                @endif
                            </td>
                        </div>
                        <!-- 繰り返し処理の中に、更新ボタンを追加→投稿の数だけボタンが自動的に作成される
                        URLにパラメータを付与 GET送信-->
                    </tr>
                    @endforeach
            </table>

        </div>
    </div>


@endsection