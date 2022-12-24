<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->Integer('id')->autoIncrement();
            $table->unsignedInteger('user_id')->unsigned();
            /* 外部キー(foreign key)
            関係データベースにおいてデータの整合性を保つための制約（参照整合性制約）*/
            $table->string('post',400);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'));
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
// ２０１１１２１６
// 構文エラーまたはアクセス違反: 1064 SQL 構文にエラーがあります。 そのマニュアルを確認してください
// 1行目のnear ')'を使用する正しい構文については、MariaDBサーバーのバージョンに対応しています（SQL：alter table `posts` add constraint `posts_user_id_foreign` fo
// reign key (`user_id`) は `` ()) を参照します

// is とuser_id の型は同じ
