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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string("map")->nullable();
            $table->string("whats_app")->nullable();
            $table->string("telegram")->nullable();
            $table->string("header_logo")->nullable();
            $table->string("favicon")->nullable();
            $table->timestamps();
        });

        Schema::create('site_setting_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_setting_id');
            $table->string('locale')->index();
            $table->string('address')->nullable();
            $table->string('terms_and_condition')->nullable();
            $table->string('start_a_project_url')->nullable();

            $table->unique(['site_setting_id', 'locale']);
            $table->foreign('site_setting_id')
                  ->references('id')
                  ->on('site_settings')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_setting_translations');
        Schema::dropIfExists('site_settings');
    }
};
