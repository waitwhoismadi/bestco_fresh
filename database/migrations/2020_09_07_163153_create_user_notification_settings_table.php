<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id')->nullable();
            $table->boolean('request_notification')->default('0');
            $table->boolean('feedcomment_notification')->default('0');
            $table->boolean('jobapply_notification')->default('0');
            $table->boolean('projectbid_notification')->default('0');
            $table->boolean('acceptbid_notification')->default('0');
            $table->boolean('message_notification')->default('0');
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
        Schema::dropIfExists('user_notification_settings');
    }
}
