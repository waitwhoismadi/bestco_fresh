<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->enum('page_type',['terms','other'])->default('other');
            $table->string('page_title',250)->nullable();
            $table->string('page_slug',250)->nullable();
            $table->longText('page_description')->nullable();
            $table->string('seo_title',200)->nullable();
            $table->mediumText('seo_tags')->nullable();
            $table->mediumText('seo_description')->nullable();
            $table->string('seo_img',250)->nullable();
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
        Schema::dropIfExists('cms_pages');
    }
}
