<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('name', 400)->nullable();
            $table->string('title', 400)->nullable();
            $table->string('description', 400)->nullable();
            $table->string('slug', 400)->nullable();
            $table->string('heading', 400)->nullable();
            $table->longText('text')->nullable();
            $table->string('image', 400)->nullable();
            $table->boolean('published')->default(true);
            $table->integer('author')->nullable();
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
        Schema::dropIfExists('blog');
    }
}
