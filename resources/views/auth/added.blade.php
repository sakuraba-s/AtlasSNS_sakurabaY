@extends('layouts.logout')

@section('content')

<div id="clear">
  <p> <?php echo $username; ?>さん</p>
  <p>ようこそ!<b>AtlasSNS</b>へ</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="button"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection