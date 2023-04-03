<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />

    <!-- JQueryを読み込む(この記述が無いと使えないよ) -->
    <script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
    <!-- scriptタグ　javaScriptやVBscriptなどのスクリプトをHTMLファイル内に埋め込んだり外部のスクリプトを読み込んだりするためにために使用する -->
    <!-- src=source attribute 外部から読み込む資源の所在の記述 -->

    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
  </head>
  <body>
    <div class="wrapper">
        <header>
            <h1><img src="images/atlas.png"></h1>
            <p>Social Network Service</p>
        </header>
        <div id="container">
            @yield('content')
        </div>
    </div>
  </body>
</html>