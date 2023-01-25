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
{{ Form::text('password',null,['class' => 'input']) }}

{{ Form::label('password-confirm') }}
{{ Form::text('password-confirm',null,['class' => 'input']) }}

{{ Form::submit('REGISTER' ,['class' => 'button'] )}}



<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
