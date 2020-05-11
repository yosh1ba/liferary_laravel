<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'isbn' => '4140814780',
            'title' => 'ソフィーの世界上',
            'author' => 'ヨースタイン・ゴルデル',
            'publisher' => 'NHK出版',
            'published_on' => '2011-05-26',
            'image' => 'https://encrypted.google.com/books/content?id=6juLZwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
