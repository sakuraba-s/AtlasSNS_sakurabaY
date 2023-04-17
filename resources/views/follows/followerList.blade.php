@extends('layouts.login')

@section('content')
<div class="followers_top top">
            <span>Folower List</span>
            <div class="followerlist_icon">
                @foreach ($followerlist as $followerlist_icon)
                @csrf
                    <form action="{{ route('othersprofile', ['id' => $followerlist_icon->id]) }}" method="POST" >
                        {{ csrf_field() }}
                        <button type="submit" ><img src=" {{ asset('storage/profiles/'.$followerlist_icon->images) }}" class="pro_img" alt="プロフィール画像"></button>
                    </form>
                @endforeach
            </div>
        </div>
        <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


        <div class="follows_bottom bottom">

            <div class="followerlist_table">
                <table class='table'>
                        <ul>
                            @foreach ($followerposts as $followerposts)
                            <li class="post_block">
                                <form action="{{ route('othersprofile', ['id' => $followerposts->user->id]) }}" method="POST" >
                                    {{ csrf_field() }}
                                    <button type="submit"><figure><img src=" {{ asset('storage/profiles/'.$followerposts->user->images) }}" class="pro_img" alt="プロフィール画像"></figure></button>
                                </form>
                                <div class="post_content">
                                    <div>
                                        <div class="post_name">{{ $followerposts->user->username }}</div>
                                        <div>{{ $followerposts->created_at }}</div>
                                    </div>
                                    <div>{{ $followerposts->post }}</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                </table>
            </div>
        </div>
@endsection