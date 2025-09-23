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
        Schema::create('about_team_contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('about_team_content_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('about_team_id');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('content2')->nullable();
            $table->string('content3')->nullable();

            $table->unique(['about_team_id', 'locale']);
            $table->foreign('about_team_id')
                  ->references('id')
                  ->on('about_team_contents')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_team_content_translations');
        Schema::dropIfExists('about_team_contents');
    }
};
