@extends('layouts.logout')

@section('content')

<p>新規ユーザー登録</p>

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

{!! Form::open(['url' => '/register','method'=>'POST']) !!}


{{ Form::label('user name') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('mail address') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('password') }}
{{ Form::password('password',null,['class' => 'input']) }}

{{ Form::label('password-confirm') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('REGISTER' ,['class' => 'button'] )}}



<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
