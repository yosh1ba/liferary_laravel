<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // idカラムは変更したくないため、ロックをかける
    protected $guarded = ['id'];

    // コメントからユーザー情報を取得できるようにする
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // コメントから投稿情報を取得できるようにする
    public function post()
    {
        return $this->belongsTo('App\Post');
    }


}
