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
        Schema::create('solution_supporting_media', function (Blueprint $table) {
            $table->id()->index();
            $table->string('key')->unique()->index();
            $table->foreignId('solutionId')->index()->constrained('solutions')->cascadeOnDelete();
            $table->boolean('base64')->nullable();
            $table->string('type')->nullable();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solution_supporting_media');
    }
};
