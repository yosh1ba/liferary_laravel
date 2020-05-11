<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    // idカラムは変更したくないため、ロックをかける
    protected $guarded = ['id'];

    // Ageモデルに対して postsメソッドが紐づくことを定義している
    // 年齢情報に紐付く投稿情報を取得できるようにする
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
