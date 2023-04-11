@extends('layouts.login')

@section('content')
<div class="follows_area top">
            <span>Folow List</span>
            <div class="followlist_icon">
                @foreach ($followlist as $followlist_icon)
                    <form action="{{ route('othersprofile', ['id' => $followlist_icon->id]) }}" method="POST" >
                        {{ csrf_field() }}
                        <button type="submit" ><img src=" {{ asset('storage/profiles/'.$followlist_icon->images) }}" alt="プロフィール画像"></button>
                    </form>
                @endforeach
            </div>
        </div>
        <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


        <div class="follows_area bottom">

            <div class="followlist_table">
                <table class='table'>
                @foreach ($followposts as $followposts)
                        <tr>
                            <td>
                            <!-- ルートパラメータとして渡したい中身をrouteヘルパーの中に描く -->
                                <form action="{{ route('othersprofile', ['id' => $followposts->user->id]) }}" method="POST" >
                                    {{ csrf_field() }}
                                    <button type="submit" ><img src=" {{ asset('storage/profiles/'.$followposts->user->images) }}" alt="プロフィール画像"></button>
                                </form>

                            </td>
                            <td>
                                <span>{{ $followposts->user->username }}</span>
                                <!-- ユーザ情報からさらにpostテーブルへのアクセスが必要 -->
                                <span>{{ $followposts->post }}</span>
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