<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        $post = Post::where('id', $id)->with(['user', 'book', 'comments.user', 'likes'])->first();
        Log::debug(print_r($post,true));
        
        return $post ?? abort(404);

    }

    // コメント投稿用メソッド
    public function addComment(Post $post, StoreComment $request)
    {

        // 現在の投稿情報（Postクラス）を $post として受け取る
        // リクエスト情報（StoreCommentクラス）を $request として受け取る

        // Commentクラスインスタンス$commentを作成
        $comment = new Comment();

        // $commentのcommentプロパティに$requestのcommentプロパティをセットする
        $comment->comment = $request->get('comment');

        // $commentのuser_idプロパティに、ログイン中のユーザIDをセットする
        $comment->user_id = Auth::user()->id;

        // $postのcommentsメソッドを実行し、DBを更新する
        $post->comments()->save($comment);

        // その投稿に関する最新のコメント一覧を取得し、HTTPレスポンスとして返す
        $new_comment = Comment::where('id', $comment->id)->with('user')->orderBy(Comment::CREATED_AT, 'desc')->first();
        return response($new_comment, 201);


    }

    // いいね追加用メソッド
    public function like(string $id)
    {
        $post = Post::where('id', $id)->with('likes')->first();

        if( !$post ){
            abort(404);
        }

        $post->likes()->detach(Auth::user()->id);
        $post->likes()->attach(Auth::user()->id);

        return ["post_id" => $id];
    }

    // いいね解除用メソッド
    public function unlike(string $id)
    {
        $post = Post::where('id', $id)->with('likes')->first();

        if( !$post ){
            abort(404);
        }

        $post->likes()->detach(Auth::user()->id);

        return ["post_id" => $id];
    }

}
