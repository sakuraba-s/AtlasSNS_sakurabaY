@extends('layouts.login')

@section('content')
    <div class="othersprofile_top top">
        <ul  class="othersprofile_content">
        @foreach ( $otheruser as  $otherprofile)
        @if ($loop->index == 0)
            <li>
                <img src=" {{ asset('storage/profiles/'.$otherprofile->user->images) }}" class="pro_img">
                <div class="post_content">
                    <div>
                        <div>name</div>
                        <div>{{ $otherprofile->user->username }}</div>
                        <div></div>
                    </div>
                    <div>
                        <div>bio</div>
                        <div>{{ $otherprofile->user->bio }}</div>
                        <div class="table_btn">
                            <!-- フォロー解除まはたフォローボタン -->
                            <!-- UserモデルのisFollowingメソッドの結果が真ならば(すでにフォローしているならば)
                            フォローを解除する。この時、解除するメソッドに解除対象のユーザーのidを渡す-->
                            @if (auth()->user()->isFollowing($otherprofile->user->id))
                                <form action="{{ route('unfollow', ['user' => $otherprofile->user->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="unfollow_btn btn"><a>フォロー解除</a></button>
                                </form>
                            @else
                                <form action="{{ route('follow', ['id' => $otherprofile->user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="follow_btn btn" ><a>フォローする</a></button>
                                </form>
                            @endif
                        </div>
                </div>
            </li>
        @endif
        @endforeach
        </ul>
    </div>
    <!-- ※$followerlisにはフォロー中のユーザー情報が入っている -->


    <div class="othersprofile_bottom bottom">

        <div class="othersposts_table">
            <table class='table'>
                    <ul>
                        @foreach ( $otheruser as  $otherpost)
                        <li>
                            <figure><img src=" {{ asset('storage/profiles/'.$otherpost->user->images) }}" class="pro_img" alt="プロフィール画像"></figure>
                            <div class="post_content">
                                <div>
                                    <div class="post_name">{{ $otherpost->user->username }}</div>
                                    <div>{{ $otherpost->created_at }}</div>
                                </div>
                                <div>
                                    <div class="post_area">{{ $otherpost->post }}</div>
                                </div>
                        </li>
                        @endforeach
                    </ul>
            </table>
        </div>
    </div>
@endsection