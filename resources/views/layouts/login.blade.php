<!DOCTYPE html>
<html>
<!-- ページでOGPを使用することを宣言 -->
<head prefix="og: https://ogp.me/ns#">
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Internet Explorerでどのバージョンのモードでレンダリングを行うか(ドキュメントモード)を指定することができるプラグマ -->
    <meta name="description" content="ページの内容を表す文章" />
    <!-- description 説明文 content="ページの説明文"-->
    <title>AtlasSNS</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!-- linkタグ 検索エンジンやブラウザに「このページは、別のこのページやファイルとこんな関係があるよ」と伝える -->
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <!--サイトのアイコン指定 ブックマーク一覧やブラウザのタブなどに表示される
    消しても表示される。。。？-->
    <!-- <link rel="icon" href="{{asset('images/atlas.png')}}" sizes="16x16" type="image/png" /> -->
    <!-- <link rel="icon" href="images/atlas.png" sizes="32x32" type="image/png" />
    <link rel="icon" href="images/atlas.png" sizes="48x48" type="image/png" />
    <link rel="icon" href="images/atlas.png" sizes="62x62" type="image/png" /> -->
    <!--
    rel:リンク先のファイルやページとの関係性を指定
    typeリンクする外部リソースのMIMEタイプ※マイムタイプとは:ファイルの種類を表す情報
    size:アイコンのサイズ-->

    <!-- JQueryを読み込む(この記述が無いと使えないよ) -->
    <script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
    <!-- scriptタグ　javaScriptやVBscriptなどのスクリプトをHTMLファイル内に埋め込んだり外部のスクリプトを読み込んだりするためにために使用する -->
    <!-- src=source attribute 外部から読み込む資源の所在の記述 -->
    <script src="https://kit.fontawesome.com/8328899644.js" crossorigin="anonymous"></script>
    <!-- フォントオーサムを読み込む記述 -->

    <!--iphoneのアプリアイコン指定 ホームページをスマホのホーム画面に追加したときに表示されるアイコン画像のこと-->
    <link rel="apple-touch-icon-precomposed" href="images/atlas.png" />
    <!--OGPタグ/twitterカード
    Open Graph Protcol
    FacebookやTwitterなどのSNSでシェアした際に、Webページのタイトルや概要、イメージ画像、URL含めた詳細情報を正しく伝えるためのHTML要素 -->
    <meta property="og:url" content="post/index" />
    <meta property="og:type" content=" website" />
    <meta property="og:title" content=" AtlasSNS" />
    <meta property="og:description" content=" SNSです" />
    <meta property="og:site_name" content="AtlasSNS" />
    <meta property="og:image" content="images/atlas.png'" />
</head>

<body>
    <header>
        <div id = "head">
            <h1><a href="/top"><img src="{{asset('images/atlas.png')}}"class="top_img"></a></h1>
            <!-- ロゴを押下するとトップページに遷移する -->
            <div id="login_user_area">
                <!-- ログイン中のユーザ情報を取得 -->
                <?php $user= Auth::user();
                $id=Auth::user()->id?>
                <p> {{ $user->username }}さん</p>

                <!-- ハンバーガメニュー -->
                <input type="button" class="menu-trigger" value="<" >
                <!-- プロフィール画像 -->
                <img src=" {{ asset('storage/profiles/'.$user->images) }}"class="pro_img" alt="プロフィール画像">

            <div>
        </div>
    </header>
    <div id="row">
        <!-- ヘッダー以外のページ全体（サイド含む） -->
        <div id="container">
            <!-- サイド以外の部分 -->
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <!-- ハンバーガー押下で出現する部分(デフォルトでは非表示にする) -->
                <div class="menu">
                    <ul>
                        <li><a href="/top">HOME</a></li>
                        <li><a href="/profile">プロフィール編集</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                </div>

                <!-- 上記メニューが表示されている時は非表示にする -->
                <p>{{ $user->username }}さんの</p>
                <div class="follow_box">
                    <div class="confirm_follow">
                        <p>フォロー数  {{ Auth::user()->follows()->where('following_id',$id)->get()->count() }}名</p>
                        <p class="list_btn btn"><a href="/follow-list">フォローリスト</a></p>
                    </div>
                    <div class="confirm_follow">
                        <p>フォロワー数  {{ Auth::user()->followers()->where('followed_id',$id)->get()->count() }}名</p>
                        <p class="list_btn btn"><a href="/follower-list">フォロワーリスト</a></p>
                    </div>
                </div>
            </div>
            <p class="listsearch_btn btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
