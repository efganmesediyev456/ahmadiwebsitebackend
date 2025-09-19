<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_flows', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('work_flow_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_flow_id');
            $table->string('locale')->index();

            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('url')->nullable();

            $table->unique(['work_flow_id', 'locale']);
            $table->foreign('work_flow_id')
                  ->references('id')
                  ->on('work_flows')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_flow_translations');
        Schema::dropIfExists('work_flows');
    }
};
