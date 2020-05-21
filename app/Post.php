<?php

namespace App;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\ErrorHandler\Debug;

class Post extends Model
{

    // TODO: JSONで返却される内容を絞り込むかどうか
    

    // idカラムは変更したくないため、ロックをかける
    protected $guarded = ['id'];

    protected $appends = [
        'likes_count', 'liked_by_user',
    ];

    // like_countアクセサ
    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    // liked_by_userアクセサ
    public function getLikedByUserAttribute()
    {
        // ログインしていなければfalseを返す
        if(Auth::guest()){
            return false;
        }

        // ログインしていれば、そのユーザーが含まれているいいねがあるかを真偽値で返す
        return $this->likes->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }

    public function user()
    {
        // 投稿からユーザー情報を取得できるようにする
        return $this->belongsTo('App\User');
    }

    public function book()
    {
        // 投稿から書籍情報を取得できるようにする
        return $this->belongsTo('App\Book');
    }

    public function age()
    {
        // 投稿から年齢情報を取得できるようにする
        return $this->belongsTo('App\Age');
    }


    // Postモデルに対して likesメソッドが紐づくことを定義している
    // 投稿からいいね情報を取得できるようにする
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    // Postモデルに対して commentsメソッドが紐づくことを定義している
    // 投稿からコメント情報を取得できるようにする
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }



}
