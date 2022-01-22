<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id')->nullable();
            $table->enum('feed_type',['job','project'])->nullable();
            $table->string('title',200)->nullable();
            $table->string('slug',200)->nullable();
            $table->integer('category')->nullable();
            $table->longText('skills')->nullable();
            $table->bigInteger('min_price')->default(0);
            $table->bigInteger('max_price')->default(0);
            $table->integer('payment_type')->nullable();
            $table->integer('job_type')->nullable();
            $table->longText('description');
            $table->boolean('is_active')->default(1);
            $table->integer('view')->default(0);
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
        Schema::dropIfExists('feeds');
    }
}
