
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
    $('.update_btn').click(function() {

    });
});   // 全体のfunctionを閉じる

