@extends('layouts.login')

    @section('content')
        <div class="othersprofile top">
            <table class='othersprofile_table'>
                <?php var_dump($otheruser)?>
                <tr>
                    <td> <img src=" {{ asset('storage/profiles/'.$otheruser->user->images) }}"></td>
                    <td>
                        <span>name{{ $otheruser->user->username }}</span>
                        <span>name{{ $otheruser->user->bio }}</span>
                    </td>
                    <td>
                        <div class="table_btn">
                                <!-- フォロー解除まはたフォローボタン -->
                                <!-- UserモデルのisFollowingメソッドの結果が真ならば(すでにフォローしているならば)
                                フォローを解除する。この時、解除するメソッドに解除対象のユーザーのidを渡す-->
                                @if (auth()->user()->isFollowing($otheruser->id))
                                    <form action="{{ route('unfollow', ['user' => $otheruser->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" >フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['id' => $otheruser->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" >フォローする</button>
                                    </form>
                                @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


        <div class="othersprofile bottom">

            <div class="othersposts_table">
                <table class='table'>
                @foreach ( $otheruser as  $otheruser)
                        <tr>
                            <td>
                                <img src=" {{ asset('storage/profiles/'.$otheruser->user->images) }}" alt="プロフィール画像">
                            </td>
                            <td>
                                <span>{{ $followerposts->user->username }}</span>
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