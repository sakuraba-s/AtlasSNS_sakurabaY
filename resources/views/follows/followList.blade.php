@extends('layouts.login')

@section('content')
<div class="follows_area top">
            <div class="followerlist_icon">
                @foreach ($followlist as $followlist_icon)

                    <img src=" {{ asset('storage/profiles/'.$followlist_icon->user->images) }}" alt="プロフィール画像">
                @endforeach
            </div>
        </div>
        <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


        <div class="follows_area bottom">

            <div class="followlist_table">
                <table class='table'>
                @foreach ($followlist as $followposts)
                        <tr>
                            <td>
                                <img src=" {{ asset('storage/profiles/'.$followposts->user->images) }}" alt="プロフィール画像">
                            </td>
                            <td>
                                <span>{{ $followposts->user->username }}</span>
                                <!-- ユーザ情報からさらにpostテーブルへのアクセスが必要 -->
                                <span>{{ $followposts->user->post }}</span>
                            </td>
                            <td>
                                <span>{{ $followposts->created_at }}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
@endsection