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
       Schema::create('company_abouts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('company_about_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_about_id');
            $table->string('locale')->index();
            
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('url')->nullable();

            $table->unique(['company_about_id', 'locale']);
            $table->foreign('company_about_id')
                  ->references('id')
                  ->on('company_abouts')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_about_translations');
        Schema::dropIfExists('company_abouts');
    }
};
