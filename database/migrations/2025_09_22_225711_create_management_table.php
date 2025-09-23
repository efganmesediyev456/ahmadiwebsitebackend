<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('managements', function (Blueprint $table) {
            $table->id();
            $table->string("image")->nullable();
            $table->string("be_url")->nullable();
            $table->string("ln_url")->nullable();
            $table->timestamps();
        });

        Schema::create('management_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('management_id');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->text('description')->nullable();

            $table->unique(['management_id', 'locale']);
            $table->foreign('management_id')
                  ->references('id')
                  ->on('managements')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('management_translations');
        Schema::dropIfExists('managements');
    }
};
