<?php

namespace App\Http\Controllers;

use App\Age;
use App\Book;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreComment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class PostController extends Controller
{
    // 投稿一覧表示用メソッド
    public function index()
    {

        $posts = Post::with(['user', 'book'])
            ->orderBy(Post::CREATED_AT, 'desc')->paginate(4);
        return $posts;
    }


    // 詳細情報表示用メソッド
    public function show(string $id)
    {

        $post = Post::where('id', $id)->with(['user', 'book', 'comments.user', 'likes'])->first();
        
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
        $comment->comment = $request->input('comment');

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

    // 年齢一覧取得用メソッド
    public function age(){
        
        $ages = Age::all();

        return $ages;
    }

		// 書籍登録用メソッド
    public function register(StorePost $request){

				$existsBook = Book::where('isbn', $request->input('book.isbn'))->first();
				
				if(!$existsBook){

					$requestAuthor =  $request->input('book.authors');

					DB::transaction(function() use($request, $requestAuthor)
					{
						$book = Book::create([
							'isbn' => $request->input('book.isbn'),
							'title' => $request->input('book.title'),
							'author' => array_shift($requestAuthor),
							'publisher' => null,
							'published_on' => $request->input('book.publishedDate'),
							'image' => $request->input('book.imageLinks.thumbnail')
							]);						
						
						Auth::user()->post()->create([
							'user_id' => $request->input('user_id'),
							'age_id' => $request->input('age_id'),
							'book_id' => $book->id,
							'head' => $request->input('head'),
							'detail' => $request->input('detail')
						]);
					});

				} else {
					DB::transaction(function() use($request, $existsBook)
					{
						Auth::user()->post()->create([
							'user_id' => $request->input('user_id'),
							'age_id' => $request->input('age_id'),
							'book_id' => $existsBook->id,
							'head' => $request->input('head'),
							'detail' => $request->input('detail')
						]);
					});
				}
				return response(200);
		}

		// 登録済み書籍参照用メソッド
		public function registerd(String $id){

			$registerd = Post::where('user_id', $id)->first();

			if($registerd){
				
				$post = Post::where('user_id', $id)->with(['book'])->first();
			
				return response($post);
			}
		}

		// 投稿削除用メソッド
		public function delete(string $id)
		{
			$post = Post::where('user_id', $id)->first();

			if( !$post ){
					abort(404);
			}

			$post->delete(Auth::user()->id);

			return ["post_id" => $id];
		}
}
