<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_social_links', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id')->nullable();
            $table->string('website',350)->nullable();
            $table->string('facebook',350)->nullable();
            $table->string('instagram',350)->nullable();
            $table->string('twitter',350)->nullable();
            $table->string('github',350)->nullable();
            $table->string('pinterest',350)->nullable();
            $table->string('youtube',350)->nullable();
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
        Schema::dropIfExists('user_social_links');
    }
}
