<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApplyJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_jobs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('job_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('name',100)->nullable();
            $table->string('email',150)->nullable();
            $table->string('contact',15)->nullable();
            $table->string('experience','50')->nullable();
            $table->string('resume','200')->nullable();
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
        Schema::dropIfExists('apply_jobs');
    }
}
