
$(function(){
     // 一つの機能を作るとき、functionでまとめる
    //  ハンバーガーメニュー
    $('.menu-trigger').click(function(){
        // 対象.menu-tigger(ハンバーガー)をクリックした時、function以下の操作をする。
        $(".menu").toggleClass('active');
        $(".menu-trigger").toggleClass('active');
        $("#confirm").toggleClass('active');

        // // toggleClassメソッド:指定したクラス名の CSS がある場合は削除を行い、なければ追加する。
        // if($(this).hasClass('active')){
        //     // if(条件)    hasClassメソッド:クラスの存在有無を調べる
        //     $('.g-navi').addClass('active'); // 条件に当てはまった場合、何をどうするか
        // }else{
        //     //それ以外の場合
        //     $('.g-navi').removeClass('active');
        // }
    });
    // ナビゲーションの表示非表示
    $('.nav-wrapper ul li a').click(function(){ // 対象nav-wrapper ul li a　をクリックした時、function以下の操作をする。
        $('.menu-trigger').removeClass('active'); // タップ後はメニューが閉じるようにactiveを外す。
        $('.g-navi').removeClass('active');
    });

    // 投稿編集のダイアログボックス
    // 編集アイコンを押下したときにダイアログボックスが出現する
    // もう一度押したら閉じる
    // 編集ボタン(class="js-modal-open")が押されたら、
    $('.js-modal-open').on('click',function(){
        // モーダルの中身(class="js-modal")の表示フェードイン
        $('.js-modal').fadeIn();
        // 押されたボタンから投稿内容を取得し変数へ格納
        // ※編集ボタンにpost属性とpost_id属性を追加し、それぞれの投稿内容と投稿idのデータを持たせてある
        // data-属性を取得
        // varは変数の定義
        var post = $(this).data('post');
        // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
        var post_id = $(this).data('post_id');

        // 取得した投稿内容をモーダルの中身(text)へ渡す
        // 文字を渡したいのでtextメソッドを使う
        $('.modal_post').text(post);
        // 取得した投稿のidをモーダルの中身(val)へ渡す
        $('.modal_id').val(post_id);
        return false;
    });

    // 投稿ボタンが押されたらモーダルを閉じる
    $('.modal_submit').on('click',function(){
        // モーダルの中身(class="js-modal")を非表示
        $('.js-modal').fadeOut();
        return false;
    });
});   // 全体のfunctionを閉じる

