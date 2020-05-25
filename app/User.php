<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // nameのみを返すようにする
    protected $visible = [
        'id',
        'name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // userモデルに対して postsメソッドが紐づくことを定義している
    // ユーザ情報に紐付く投稿情報を取得できるようにする
    public function post()
    {
        return $this->hasOne('App\Post');
    }

    // Userモデルに対して commentsメソッドが紐づくことを定義している
    // ユーザ情報に紐付く投稿情報を取得できるようにする
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // Userモデルに対して likesメソッドが紐づくことを定義している
    // ユーザ情報に紐付く投稿情報を取得できるようにする
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
