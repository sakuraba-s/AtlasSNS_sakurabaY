@extends('layouts.login')
    @section('content')
            <!-- バリデーションのエラーを表示 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $errors)
                    <li>{{$errors}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                $images= \Auth::user()->images;
                $id= \Auth::user()->id;
                $bio= \Auth::user()->bio;
                ?>
                <table>

                {!! Form::open(['url' => '/edit','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                {!! Form::hidden('id',$id)!!}
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
                    <td>{!! Form::input('password','password',null,['required','class'=> 'form-control']) !!}</td>
                </tr>

                <tr>
                    <th>{{ Form::label('password confirm') }}</th>
                    <td>{!! Form::input('password','password_confirmation',null,['required','class'=> 'form-control']) !!}</td>
                </tr>

                <tr>
                    <th>{{ Form::label('bio') }}</th>
                    <td>{!! Form::input('text','bio',$bio,['class'=> 'form-control']) !!}</td>
                </tr>

                <tr>
                    <th>{{ Form::label('icon image') }}</th>
                    <td>{!! Form::input('file','images',null,['class'=> 'form-control']) !!}</td>
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