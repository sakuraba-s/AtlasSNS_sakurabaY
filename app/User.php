<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // ★postsテーブルとのリレーション(親子関係)
    public function posts()
    {
        return $this->hasMany('App\Post');
    }


    // ★フォロー関係のリレーション
    // フォローされているユーザIDから、フォローしているユーザIDにアクセス
    // 第一引数で参照するテーブルを指定(今回は自分自身)
    // 第二引数には中間テーブルとなるfolloersテーブルを指定
    public function followers(){
        return $this->belongsToMany(self::class,"followers",'followed_id', 'following_id');
    }
    // ★フォロー関係のリレーション
    // フォローしているユーザIDから、フォローされているユーザIDにアクセス
    public function follows(){
        return $this->belongsToMany(self::class,"followers",'following_id', 'followed_id');
    }

    // フォローする
    // コントローラーで引数として渡したidをIntで受け取る
    // attach 新たにリレーションに紐づけする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }
    // フォロー解除する
    // detach リレーションを解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }
    // フォローしているか
    // boolean真か偽かを表す変数の型
    public function isFollowing(Int $user_id)
    {
    // 「follows」を使用
    // つまりフォローしているユーザIDから、フォローされているユーザIDにアクセスし、フォローしているかの判定をする
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id) 
    {
    // 「followers」を使用
    // つまりフォローされているユーザIDから、フォローしているユーザIDにアクセスし、フォローされているかの判定をする
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

}
