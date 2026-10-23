<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Kesehatan');
            $table->string('author')->default('Tim Medis RSIA Restu Bunda');
            $table->date('published_at')->nullable();
            $table->text('excerpt');
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
