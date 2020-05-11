<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => '1',
            'age_id' => '1',
            'book_id' => '1',
            'head' => '楽しく、考えるための本',
            'detail' => '普通の少女であるソフィーの元にある日、不思議な手紙が舞い込みます。そこから、読者もソフィーに届く同じ哲学の話を読んでいくことになります。物語を通じて、自分も主人公と同じ体験をしているような気持ちになれます。難しいと思われる哲学でも語り口が面白く、物語を追いながら読み進めていくので、あまり苦になりませんでした。そのため、西洋哲学について楽しく学ぶことができる本です。',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
