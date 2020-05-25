<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GoogleBooks;

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

        // 認証ユーザー取得
        Route::get('/user', fn() => Auth::user())->name('user');

        // 退会
        Route::post('/withdraw', 'Auth\LoginController@withdraw')->name('withdraw');

        // 投稿一覧取得
        Route::get('/posts', 'PostController@index')->name('post.index');

        // 投稿詳細取得
        Route::get('/posts/{id}', 'PostController@show')->name('post.show')->where('id', '[0-9]+');

        // コメント
        Route::post('/posts/{post}/comments', 'PostController@addComment')->name('post.comment');

        // いいね追加
        Route::put('/posts/{post}/like', 'PostController@like')->name('post.like');

        // いいね解除
        Route::delete('/posts/{id}/like', 'PostController@unlike')->where('id', '[0-9]+');

        // 年齢一覧取得
        Route::get('/ages', 'PostController@age')->name('age');

        // 書籍登録
        Route::post('/posts/register', 'PostController@register')->name('post.register');

        // 登録済み書籍取得
        Route::get('/posts/registerd/{id}', 'PostController@registerd')->name('post.registerd');

        // 投稿情報削除
        Route::delete('/posts/registerd/{id}', 'PostController@delete')->name('post.delete');

        // GoogleBooksAPI
        Route::post('/book', 'GoogleBooks')->name('book');

    });


// 上記ルーティングに当てはまらない場合のデフォルトルート的な意味合い
// 上部に記述すると、JSONの返り値がHTMLになる地獄を見るため注意
Route::get('/{any?}', fn() => view('index'))->where('any', '.+');
