<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('page_type')->nullable();
            $table->string('seo_title',200)->nullable();
            $table->mediumText('seo_tags')->nullable();
            $table->mediumText('seo_description')->nullable();
            $table->string('seo_img',300)->nullable();
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
        Schema::dropIfExists('seo_settings');
    }
}
