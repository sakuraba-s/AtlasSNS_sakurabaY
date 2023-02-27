<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Follow extends Authenticatable
{
    // 登録/更新を許可
    protected $fillable = ['following_id','followed_id'];
}
