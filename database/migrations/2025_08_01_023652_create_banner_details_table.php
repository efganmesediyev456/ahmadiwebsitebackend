<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('banner_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        // Translatable banners table
        Schema::create('banner_detail_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banner_id');
            $table->string('locale')->index();
            
            $table->string('title')->nullable();
            $table->string('url')->nullable();

            $table->unique(['banner_id', 'locale']);
            $table->foreign('banner_id')
                  ->references('id')
                  ->on('banner_details')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_detail_translations');
        Schema::dropIfExists('banner_details');
    }
};
