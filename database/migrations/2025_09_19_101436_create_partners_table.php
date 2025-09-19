<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->tinyInteger('floor')->default(1); // 1, 2, 3
            $table->timestamps();
        });

        Schema::create('partner_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            $table->string('locale')->index();
            $table->string('url')->nullable();

            $table->unique(['partner_id', 'locale']);
            $table->foreign('partner_id')
                  ->references('id')
                  ->on('partners')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_translations');
        Schema::dropIfExists('partners');
    }
};
