<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // idカラムは変更したくないため、ロックをかける
    protected $guarded = ['id'];

    public function users()
    {
        // Likeモデルに対して usersメソッドが紐づくことを定義している
        // いいね情報に紐付くユーザー情報を取得できるようにする
        return $this->belongsTo('App\User');
    }

    public function posts()
    {
        // Likeモデルに対して postsメソッドが紐づくことを定義している
        // いいね情報に紐付く投稿情報を取得できるようにする
        return $this->belongsTo('App\Post');
    }
}
