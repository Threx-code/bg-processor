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
        Schema::create('adp_metrics', function (Blueprint $table) {
            $table->id()->index();
            $table->string('key')->unique()->index();
            $table->foreignId('adpId')->index()->constrained('adps')->cascadeOnDelete();
            $table->string('type')->nullable();
            $table->string('contentId')->nullable();
            $table->string('role')->nullable();
            $table->string('exploitation')->nullable();
            $table->string('automatable')->nullable();
            $table->string('technicalImpact')->nullable();
            $table->string('version')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adp_metrics');
    }
};
