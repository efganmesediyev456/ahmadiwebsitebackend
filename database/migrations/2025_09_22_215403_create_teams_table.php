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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string("image")->nullable();
            $table->string("be_url")->nullable();
            $table->string("ln_url")->nullable();
            $table->timestamps();
        });

        Schema::create('team_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->string('position')->nullable();

            $table->unique(['team_id', 'locale']);
            $table->foreign('team_id')
                  ->references('id')
                  ->on('teams')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_translations');
        Schema::dropIfExists('teams');
    }
};
