<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // 作りたいテーブルの名前とカラムの構造 スキーマビルダを使って記述
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Integer('id')->autoIncrement()->unsigned();
            $table->string('username',255);
            $table->string('mail',255);
            $table->string('password',255);
            $table->string('bio',400)->nullable();
            $table->string('images',255)->default('icon1.png');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'));
            // ユニーク設定
            $table->unique(['mail']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // テーブルを削除する
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
