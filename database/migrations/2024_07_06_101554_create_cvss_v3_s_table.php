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
        Schema::create('cvss_v3s', function (Blueprint $table) {
            $table->id()->index();
            $table->string('key')->unique()->index();
            $table->foreignId('metricId')->index()->constrained('metrics')->cascadeOnDelete();
            $table->string('attackComplexity')->nullable();
            $table->string('attackVector')->nullable();
            $table->string('availabilityImpact')->nullable();
            $table->decimal('baseScore')->nullable();
            $table->string('baseSeverity')->nullable();
            $table->string('confidentialityImpact')->nullable();
            $table->string('integrityImpact')->nullable();
            $table->string('privilegesRequired')->nullable();
            $table->string('scope')->nullable();
            $table->string('userInteraction')->nullable();
            $table->string('vectorString')->nullable();
            $table->string('version')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvss_v3s');
    }
};
