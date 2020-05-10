<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// APIのURL以外のリクエストに対してはindexテンプレートを返す
// 画面遷移はフロントエンドのVueRouterが制御する


// 同一オリジンAPI
Route::prefix('api')
    ->group(function () {
        // 登録
        Route::post('/register', 'Auth\RegisterController@register')->name('register');

        // ログイン
        Route::post('/signin', 'Auth\LoginController@login')->name('signin');

        // ログアウト
        Route::post('/signout', 'Auth\LoginController@logout')->name('signout');

        Route::get('/user', fn() => Auth::user())->name('user');

    });


// 上記ルーティングに当てはまらない場合のデフォルトルート的な意味合い
// 上部に記述すると、JSONの返り値がHTMLになる地獄を見るため注意
Route::get('/{any?}', fn() => view('index'))->where('any', '.+');
