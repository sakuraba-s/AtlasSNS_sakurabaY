@extends('layouts.login')

    @section('content')
        <div class="follows_area top">
            <div class="followerlist_icon">
                @foreach ($followerlist as $followerlist_icon)

                    <img src=" {{ asset('storage/profiles/'.$followerlist_icon->user->images) }}" alt="プロフィール画像">
                @endforeach
            </div>
        </div>
        <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


        <div class="follows_area bottom">

            <div class="followlist_table">
                <table class='table'>
                @foreach ($followerlist as $followerposts)
                        <tr>
                            <td>
                                <img src=" {{ asset('storage/profiles/'.$followerposts->user->images) }}" alt="プロフィール画像">
                            </td>
                            <td>
                                <span>{{ $followerposts->user->username }}</span>
                                <!-- ユーザ情報からさらにpostテーブルへのアクセスが必要 -->
                                <span>{{ $followerposts->user->post }}</span>
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