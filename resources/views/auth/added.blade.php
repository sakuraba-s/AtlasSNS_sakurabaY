@extends('layouts.logout')

@section('content')

<div id="clear">
  <p> {{session('username')}}さん</p>
  <p>ようこそ!<b>AtlasSNS</b>へ</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  {!! Form::open(['url' => '/login','method'=>'POST']) !!}
    @csrf
      {{ Form::submit('ログイン画面へ' , ['class' => 'button'] )}}
  {!! Form::close() !!}
</div>

@endsection