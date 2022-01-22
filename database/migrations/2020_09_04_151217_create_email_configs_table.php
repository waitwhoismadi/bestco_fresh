<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_configs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->mediumText('mail_host')->nullable();
            $table->mediumText('mail_port')->nullable();
            $table->mediumText('mail_encryption')->nullable();
            $table->mediumText('mail_username')->nullable();
            $table->mediumText('mail_password')->nullable();
            $table->mediumText('from_email')->nullable();
            $table->mediumText('from_name')->nullable();
            $table->mediumText('to_email')->nullable();
            $table->mediumText('to_name')->nullable();
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
        Schema::dropIfExists('email_configs');
    }
}
