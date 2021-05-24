<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loto_id')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('country')->nullable();
            $table->string('image')->nullable();
            $table->string('currency')->nullable();
            $table->bigInteger('jackpot')->nullable();
            $table->float('rating')->nullable();
            $table->boolean('bonusball')->nullable();
            $table->boolean('reintegro')->nullable();
            $table->boolean('extra')->nullable();
            $table->integer('regular_min')->nullable();
            $table->integer('regular_max')->nullable();
            $table->integer('regular_per_line')->nullable();
            $table->integer('special_min')->nullable();
            $table->integer('special_max')->nullable();
            $table->integer('special_per_line')->nullable();
            $table->bigInteger('close_date')->nullable();
            $table->bigInteger('countdown')->nullable();
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
        Schema::dropIfExists('lottery');
    }
}
