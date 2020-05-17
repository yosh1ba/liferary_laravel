<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿一覧表示用メソッド
    public function index()
    {

        $posts = Post::with(['user', 'book'])
            ->orderBy(Post::CREATED_AT, 'desc')->paginate(6);
        return $posts;
    }


    // 詳細情報表示用メソッド
    public function show(string $id)
    {

        $post = Post::where('id', $id)->with(['user', 'book'])->first();

        return $post ?? abort(404);

    }

}
