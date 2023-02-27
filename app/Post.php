<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 論理削除（削除してもDBには残るがシステム上削除したとみなす機能）
    use SoftDeletes;
    //
    protected $fillable = ['post','user_id'];

        // usersテーブルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
