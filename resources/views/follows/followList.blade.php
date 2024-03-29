@extends('layouts.login')

@section('content')
    <div class="follow_top top">
                <span>Folow List</span>
                <div class="list_icon">
                    @foreach ($followlist as $followlist_icon)
                        <form action="{{ route('othersprofile', ['id' => $followlist_icon->id]) }}" method="POST" >
                            {{ csrf_field() }}
                            <button type="submit" ><img src=" {{ asset('storage/profiles/'.$followlist_icon->images) }}" class="pro_img" alt="プロフィール画像"></button>
                        </form>
                    @endforeach
                </div>
    </div>
        <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


    <div class="follows_bottom bottom">

        <div class="followlist_table">
            <table class='table'>
                    <ul>
                        @foreach ($followposts as $followposts)
                        <li class="post_block">
                                <!-- ルートパラメータとして渡したい中身をrouteヘルパーの中に描く -->
                                <form action="{{ route('othersprofile', ['id' => $followposts->user->id]) }}" method="POST" >
                                    {{ csrf_field() }}
                                    <button type="submit" ><figure><img src=" {{ asset('storage/profiles/'.$followposts->user->images) }}" class="pro_img" alt="プロフィール画像"></figure></button>
                                </form>
                                <div class="post_content">
                                    <div>
                                        <div class="post_name">{{ $followposts->user->username }}</div>
                                        <div>{{ $followposts->created_at }}</div>
                                    </div>
                                    <div>{{ $followposts->post }}</div>
                                </div>
                            </td>
                        </li>
                        @endforeach
                    </ul>
            </table>
        </div>
    </div>
@endsection