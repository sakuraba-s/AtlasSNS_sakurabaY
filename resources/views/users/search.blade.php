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
                <!-- ※この↓usersはUsersコントローラで取得したユーザのデータ -->
                @foreach ($users as $user)
                    <tr>
                        <td><img src=" {{ asset('storage/profiles/'.$user->images) }}" alt="プロフィール画像"></td>
                        <td>{{ $user->username }}</td>

                        <div class="table_btn">
                            <!-- フォロー解除まはたフォローボタン -->
                            <!-- UserモデルのisFollowingメソッドの結果が真ならば(すでにフォローしているならば)
                            フォローを解除する。この時、解除するメソッドに解除対象のユーザーのidを渡す-->
                            @if (auth()->user()->isFollowing($user->id))
                                <form action="{{ route('unfollow', ['id' => $users->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <td> <button type="submit" >フォローする</button></td>
                                </form>
                            @else
                                <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" >フォロー解除</button>
                                </form>
                            @endif


                        </div>
                        <!-- 繰り返し処理の中に、更新ボタンを追加→投稿の数だけボタンが自動的に作成される
                        URLにパラメータを付与 GET送信-->
                    </tr>
                    @endforeach
            </table>

        </div>
    </div>


@endsection