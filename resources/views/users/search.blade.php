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
                    <div class="search_result">
                    <p>検索ワード：{{$search_word}}</p>
                    </div>
                @endif

        </div>
    </div>

    <div class="search_bottom bottom">
        <div class="search_results">
            <table class="table">
                <!-- ※この↓usersはUsersコントローラで取得したユーザのデータ -->
                    <ul>
                    @foreach ($users as $user)
                    <li>
                        <figure class="search_figure"><img src=" {{ asset('storage/profiles/'.$user->images) }}" class="pro_img" alt="プロフィール画像"></figure>
                        <div class="post_content search_content">
                            <div>
                                <div class="search_name">{{ $user->username }}</div>
                                <div class="table_btn">
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
                                </div>
                            </div>
                        </div>
                        <!-- 繰り返し処理の中に、更新ボタンを追加→投稿の数だけボタンが自動的に作成される
                        URLにパラメータを付与 GET送信-->
                    </li>
                    @endforeach
                    </ul>
            </table>
        </div>
    </div>


@endsection