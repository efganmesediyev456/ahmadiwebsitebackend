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
        Schema::create('mobil_programs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("left_or_right")->default(0)->comment("0 left, 1 right");
            $table->string("image")->nullable();
            $table->timestamps();
        });

        Schema::create('mobil_program_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobil_program_id');
            $table->string('locale')->index();
            
            $table->string('url')->nullable();

            $table->unique(['mobil_program_id', 'locale']);
            $table->foreign('mobil_program_id')
                  ->references('id')
                  ->on('mobil_programs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil_program_translations');
        Schema::dropIfExists('mobil_programs');
    }
};
