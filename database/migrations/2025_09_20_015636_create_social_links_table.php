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
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('image')->nullable(); // 🔥 Şəkil sütunu əlavə olundu
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->smallInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('social_link_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('social_link_id');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->timestamps();

            $table->unique(['social_link_id', 'locale']);

            $table->foreign('social_link_id')
                ->references('id')
                ->on('social_links')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_link_translations');
        Schema::dropIfExists('social_links');
    }
};
