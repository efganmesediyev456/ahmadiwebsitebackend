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
        Schema::create('who_we_do_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("who_we_do_id")->nullable();
            $table->foreign("who_we_do_id")->references("id")->on("who_we_dos")->onDelete('cascade');
            $table->timestamps();
        });

         Schema::create('who_we_do_item_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('who_we_do_item_id');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->unique(['who_we_do_item_id', 'locale']);
            $table->foreign('who_we_do_item_id')
                  ->references('id')
                  ->on('who_we_do_items')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('who_we_do_items');
    }
};
