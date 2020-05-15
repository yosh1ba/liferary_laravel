<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    // TODO: JSONで返却される内容を絞り込むかどうか
    

    // idカラムは変更したくないため、ロックをかける
    protected $guarded = ['id'];

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
        return $this->hasMany('App\Like');
    }

    // Postモデルに対して commentsメソッドが紐づくことを定義している
    // 投稿からコメント情報を取得できるようにする
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }



}
