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
        // Main banners table
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_url')->nullable();
            $table->timestamps();
        });

        // Translatable banners table
        Schema::create('banner_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banner_id');
            $table->string('locale')->index();
            
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();

            $table->unique(['banner_id', 'locale']);
            $table->foreign('banner_id')
                  ->references('id')
                  ->on('banners')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_translations');
        Schema::dropIfExists('banners');
    }
};
