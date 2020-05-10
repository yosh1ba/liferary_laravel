<?php

// APIのURL以外のリクエストに対してはindexテンプレートを返す
// 画面遷移はフロントエンドのVueRouterが制御する
Route::get('/{any?}', fn() => view('index'))->where('any', '.+');

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
