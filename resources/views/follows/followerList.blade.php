@extends('layouts.login')

@section('content')
<div class="followers_area top">
            <span>Folower List</span>
            <div class="followerlist_icon">
                @foreach ($followerlist as $followerlist_icon)
                @csrf
                    <form action="{{ route('othersprofile', ['id' => $followerlist_icon->id]) }}" method="POST" >
                        {{ csrf_field() }}
                        <button type="submit" ><img src=" {{ asset('storage/profiles/'.$followerlist_icon->images) }}" alt="プロフィール画像"></button>
                    </form>
                @endforeach
            </div>
        </div>
        <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


        <div class="follows_area bottom">

            <div class="followerlist_table">
                <table class='table'>
                @foreach ($followerposts as $followerposts)
                        <tr>
                            <td>
                                <form action="{{ route('othersprofile', ['id' => $followerposts->user->id]) }}" method="POST" >
                                    {{ csrf_field() }}
                                    <button type="submit" ><img src=" {{ asset('storage/profiles/'.$followerposts->user->images) }}" alt="プロフィール画像"></button>
                                </form>

                            </td>
                            <td>
                                <span>{{ $followerposts->user->username }}</span>
                                <!-- ユーザ情報からさらにpostテーブルへのアクセスが必要 -->
                                <span>{{ $followerposts->post }}</span>
                            </td>
                            <td>
                                <span>{{ $followerposts->created_at }}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
@endsection