@extends('layouts.login')
    @section('content')
        <div class="profile">
            <div class="profile_area_user">
                <img src="images/icon1.png">
            </div>
            <div class="profile_area_content">
                {!! Form::open(['url' => '/profile','method'=>'POST']) !!}

                {{ Form::label('user name') }}
                {!! Form::text('username',null,['required','class'=> 'form-control','placeholder' =>'ユーザ名']) !!}

                {{ Form::label('mail address') }}
                {!! Form::text('mail',null,['required','class'=> 'form-control','placeholder' =>'メールアドレス']) !!}

                {{ Form::label('password') }}
                {!! Form::password('password',null,['required','class'=> 'form-control','placeholder' =>'パスワード']) !!}
                {{ Form::label('password confirm') }}
                {!! Form::password('password_confirmation',null,['required','class'=> 'form-control','placeholder' =>'パスワード確認']) !!}

                {{ Form::label('bio') }}
                {!! Form::text('bio',null,['class'=> 'form-control']) !!}

                {{ Form::label('icon image') }}
                {!! Form::text('image',null,['required','class'=> 'form-control']) !!}


                <button type="submit"class="post_btn">更新</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- 編集、削除の際にidをGETで渡す
        編集、削除ボタンは自分の投稿にのみ表示 -->

    <!-- endforeachする -->
    @endsection