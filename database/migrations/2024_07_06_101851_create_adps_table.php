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
        Schema::create('adps', function (Blueprint $table) {
            $table->id()->index();
            $table->string('key')->unique()->index();
            $table->foreignId('cveId')->index()->constrained('cves')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->uuid('orgId')->nullable();
            $table->string('shortName')->nullable();
            $table->timestamp('dateUpdated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adps');
    }
};
