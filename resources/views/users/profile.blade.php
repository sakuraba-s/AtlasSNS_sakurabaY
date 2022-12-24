@extends('layouts.login')

@section('content')
<div class="container">

    <div class="profile_area_user">
        <img src="images/icon1.png">
    </div>
    <div class="profile_area_content">
        {!! Form::input('text','newPost',null,['required','class'=> 'form-control','placeholder' =>'投稿内容を入力してください']) !!}
        <span>user name</span>
        <span>mail adress</span>
        <span>password</span>
        <span>password comfirm</span>
        <span>bio</span>
        <span>icon image</span>
        <button type="submit"class="post_btn">更新</button>
        {!! Form::close() !!}

    <!-- 編集、削除の際にidをGETで渡す
    編集、削除ボタンは自分の投稿にのみ表示 -->

<!-- endforeachする -->

</div>

@endsection