@extends('layouts.logout')

@section('content')


{!! Form::open(['url' => '/login','method'=>'POST']) !!}

<p>AtlasSNSへようこそ</p>

{{ Form::label('mail address') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('LOGIN' , ['class' => 'button'] )}}
<!-- フォームファザード
・formopenでデータの送り先を指定する
・その際パラメータも一緒に送る
・：の後はメソッド名
・引数の意味
第一引数：name属性の値
第二引数：value属性の値
第三引数：「class」「placeholder」など追加の属性-->


<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection