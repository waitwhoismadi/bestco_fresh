<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_bids', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('project_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->bigInteger('your_bid')->nullable();
            $table->integer('delivery_time')->nullable();
            $table->longText('description')->nullable();
            $table->enum('bid_status',['open','accept','close']);
            $table->enum('payment_status',['done','pending']);
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
        Schema::dropIfExists('project_bids');
    }
}
