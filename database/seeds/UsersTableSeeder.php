<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DBファサードを使ってデータを入れる
        DB::table('users')->insert([
                'username'=>'櫻庭結菜',
                'mail'=>'yunyun.art.19@outlook.jp',
                'password'=>bcrypt('sakurabayuna0609'),
        ]);
        }
}