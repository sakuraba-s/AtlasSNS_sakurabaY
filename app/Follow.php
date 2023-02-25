<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Follow extends Authenticatable
{
    protected $fillable = ['following_id','followed_id'];
}
