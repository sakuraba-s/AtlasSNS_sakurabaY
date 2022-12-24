<!DOCTYPE html>
<html>
<head prefix="og: https://ogp.me/ns#">
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Internet Explorerでどのバージョンのモードでレンダリングを行うか(ドキュメントモード)を指定することができるプラグマ -->
    <meta name="description" content="ページの内容を表す文章" />
    <!-- description 説明文 content="ページの説明文"-->
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!-- linkタグ 検索エンジンやブラウザに「このページは、別のこのページやファイルとこんな関係があるよ」と伝える -->
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <!--サイトのアイコン指定 ブックマーク一覧やブラウザのタブなどに表示される(;'∀')どの画像？-->
    <link rel="icon" href="images/atlas.png" sizes="16x16" type="image/png" />
    <link rel="icon" href="images/atlas.png" sizes="32x32" type="image/png" />
    <link rel="icon" href="images/atlas.png" sizes="48x48" type="image/png" />
    <link rel="icon" href="images/atlas.png" sizes="62x62" type="image/png" />
    <!--
    rel:リンク先のファイルやページとの関係性を指定
    typeリンクする外部リソースのMIMEタイプ※マイムタイプとは:ファイルの種類を表す情報
    size:アイコンのサイズ-->

    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード
    Open Graph Protcol
    FacebookやTwitterなどのSNSでシェアした際に、Webページのタイトルや概要、イメージ画像、URL含めた詳細情報を正しく伝えるためのHTML要素 -->
    <meta property="og:url" content="post/index" />
    <meta property="og:type" content=" ページの種類" />
    <meta property="og:title" content=" ページのタイトル" />
    <meta property="og:description" content=" ページの説明文" />
    <meta property="og:site_name" content="サイト名" />
    <meta property="og:image" content=" サムネイル画像のURL" />
</head>

<body>
    <header>
        <div id = "head">
            <h1><a><img src="images/atlas.png"></a></h1>
            <div id="login_user_area">
                <p>adminさん</p>
                <ul>
                    <!-- ハンバーガメニューを作る -->
                    <span></span>
                    <span></span>

                    <li><a href="/top">ホーム</a></li>
                    <li><a href="/profile">プロフィール</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
                <img src="images/icon1.png">
            <div>
        </div>
    </header>
    <div id="row">
        <div id="container">


@yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>〇〇さんの</p>

                <div class="confirm_follow">
                    <div class="confirm_follow--num">
                        <p>フォロー数</p>
                        <p>〇〇名</p>
                    </div>
                    <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                </div>


                <div class="confirm_follow">
                    <div class="confirm_follow--num">
                        <p>フォロワー数</p>
                        <p>〇〇名</p>
                    </div>
                    <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
                </div>


            </div>
            <p class="btn"><a href="">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
