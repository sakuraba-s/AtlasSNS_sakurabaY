@extends('layouts.login')

@section('content')
    <div class="othersprofile top">
        <table class='othersprofile_table'>
            @foreach ( $otheruser as  $otherprofile)
            @if ($loop->index == 0)
                <tr>
                    <td> <img src=" {{ asset('storage/profiles/'.$otherprofile->user->images) }}"></td>
                    <td>
                        <span>name{{ $otherprofile->user->username }}</span>
                        <span>{{ $otherprofile->user->bio }}</span>
                    </td>
                    <td>
                        <div class="table_btn">
                                <!-- フォロー解除まはたフォローボタン -->
                                <!-- UserモデルのisFollowingメソッドの結果が真ならば(すでにフォローしているならば)
                                フォローを解除する。この時、解除するメソッドに解除対象のユーザーのidを渡す-->
                                @if (auth()->user()->isFollowing($otherprofile->user->id))
                                    <form action="{{ route('unfollow', ['user' => $otherprofile->user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" >フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['id' => $otherprofile->user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" >フォローする</button>
                                    </form>
                                @endif
                        </div>
                    </td>
                </tr>
            @endif
            @endforeach
        </table>
    </div>
    <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


    <div class="othersprofile bottom">

        <div class="othersposts_table">
            <table class='table'>
            @foreach ( $otheruser as  $otherpost)
                    <tr>
                        <td>
                            <img src=" {{ asset('storage/profiles/'.$otherpost->user->images) }}" alt="プロフィール画像">
                        </td>
                        <td>
                            <span>{{ $otherpost->user->username }}</span>
                            <span>{{ $otherpost->post }}</span>
                        </td>
                        <td>
                            <span>{{ $otherpost->created_at }}</span>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection