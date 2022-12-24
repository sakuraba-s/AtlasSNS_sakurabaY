<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at'

    ];

}

/* ホワイトリスト方式:データ登録許可するカラムを指定 fileable
ブラックリスト方式:データ登録をさせないカラムを指定 guarded*/