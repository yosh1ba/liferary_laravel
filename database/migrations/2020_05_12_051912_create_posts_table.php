<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('age_id');
            $table->unsignedBigInteger('book_id');
            $table->string('head');
            $table->text('detail');
            $table->timestamps();

            // ユーザーが削除されたら、紐付く投稿も削除する
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // 年齢が削除されたら、紐付く投稿も削除する
            $table->foreign('age_id')->references('id')->on('ages')->onDelete('cascade');

            // 書籍が削除されたら、紐付く投稿も削除する
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['age_id']);
            $table->dropForeign(['book_id']);
        });

        Schema::dropIfExists('posts');
    }
}

