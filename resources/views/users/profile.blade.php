@extends('layouts.login')
    @section('content')
        <div class="profile">
            <div class="profile_area_user">
                <img src="images/icon1.png">
            </div>
            <div class="profile_area_content">
                <!-- ログイン中のユーザ情報の取得 -->
                <?php
                $username= \Auth::user()->username;
                $mail= \Auth::user()->mail;
                $password= \Auth::user()->password;
                ?>
                <table>

                {!! Form::open(['url' => '/update','method'=>'POST']) !!}
                <tr>
                    <th>{{ Form::label('user name') }}</th>
                    <td>{!! Form::input('text','username',$username,['required','class'=> 'form-control'] ) !!}</td>
                </tr>

                <tr>
                    <th>{{ Form::label('mail address') }}</th>
                    <td>{!! Form::input('text','mail',$mail,['required','class'=> 'form-control']) !!}</td>
                </tr>

                <tr>
                    <th>{{ Form::label('password') }}</th>
                    <td>{!! Form::input('password','password',$password,['required','class'=> 'form-control']) !!}</td>
                </tr>

                <tr>
                    <th>{{ Form::label('password confirm') }}</th>
                    <td>{!! Form::input('password','password_confirmation',$password,['required','class'=> 'form-control']) !!}</td>
                </tr>

                <tr>
                    <th>{{ Form::label('bio') }}</th>
                    <td>{!! Form::input('text','bio',null,['class'=> 'form-control']) !!}</td>
                </tr>

                <tr>
                    <th>{{ Form::label('icon image') }}</th>
                    <td>{!! Form::text('image',null,['class'=> 'form-control']) !!}</td>
                </tr>
                </table>
                <button type="submit"class="post_btn">更新</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- 編集、削除の際にidをGETで渡す
        編集、削除ボタンは自分の投稿にのみ表示 -->

    <!-- endforeachする -->
    @endsection