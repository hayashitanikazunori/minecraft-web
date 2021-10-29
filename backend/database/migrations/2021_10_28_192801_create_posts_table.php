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
            $table->string('title', 100)->comment('タイトル');
            $table->string('thumbnail_images')->comment('サムネイル画像');
            $table->string('description', 255)->comment('概要');
            $table->string('material', 255)->comment('材料');
            $table->string('recipe', 1000)->comment('作り方');
            $table->string('publicing_status', 3)->comment('公開ステータス');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
