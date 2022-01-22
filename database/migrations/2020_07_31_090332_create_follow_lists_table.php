<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_lists', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('follow_by')->nullable();
            $table->integer('follow_to')->nullable();
            $table->enum('follow_status',['approve','pending'])->nullable();
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
        Schema::dropIfExists('follow_lists');
    }
}
