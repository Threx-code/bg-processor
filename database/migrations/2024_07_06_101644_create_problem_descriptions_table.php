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
        Schema::create('problem_descriptions', function (Blueprint $table) {
            $table->id()->index();
            $table->string('key')->unique()->index();
            $table->foreignId('problemTypeId')->index()->constrained('problem_types')->cascadeOnDelete();
            $table->string('cweId')->nullable();
            $table->string('lang')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problem_descriptions');
    }
};
