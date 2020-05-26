<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoogleBooks extends Controller
{
	/**
		 * Handle the incoming request.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function __invoke(Request $isbn)
		{
			
			// APIの基本となるURL
			$base_url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:';
	
			// 基本となるURLにISBNコードを付け足す
			$url = $base_url.$isbn->get('isbn');

			// 書籍情報を取得
			$json = file_get_contents($url);

			// デコード（$jsonをオブジェクトに変換する）
			$data = json_decode($json,true);

			if(($data['totalItems']) === 0){
					$books = null;
			}else{
					// 書籍情報を格納
					$books = $data['items'][0]['volumeInfo'];
					Log::debug($books);

					// 著者情報がない場合のダミーデータ
					if(!array_key_exists('authors',$books)){
						$books['authors'][0] = '著者情報なし';
					}

					// 
					if(!array_key_exists('publishedDate',$books)){
						$books['publishedDate'] = '出版日情報なし';
					}

					if(!array_key_exists('imageLinks',$books)){
						$books['imageLinks']['thumbnail'] = '/img/noimage.png';
					}else {
						$books['imageLinks']['thumbnail'] = str_ireplace('http://books.google.com','https://encrypted.google.com',$books['imageLinks']['thumbnail']);
					}



			}
			// 書籍情報を返す
			return $books;
			
			}
}
