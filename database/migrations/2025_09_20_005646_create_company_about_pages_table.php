<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('company_about_pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('company_about_page_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('locale')->index();
            
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->longText('content2')->nullable();
            $table->longText('content3')->nullable();
            $table->string('founded')->nullable();
            $table->string('team')->nullable();

            $table->unique(['company_id', 'locale']);
            $table->foreign('company_id')
                  ->references('id')
                  ->on('company_about_pages')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_about_page_translations');
        Schema::dropIfExists('company_about_pages');
    }
};
