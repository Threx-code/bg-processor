<?php declare(strict_types=1);

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
        Schema::create('cnas', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid('key')->unique()->index();
            $table->foreignId('cveId')->index()->constrained('cves')->cascadeOnDelete();
            $table->jsonb('providerMetadata')->nullable();
            $table->jsonb('descriptions')->nullable();
            $table->jsonb('affected')->nullable();
            $table->jsonb('references')->nullable();
            $table->jsonb('problemTypes')->nullable();
            $table->text('title')->nullable();
            $table->jsonb('xGenerator')->nullable();
            $table->jsonb('xLegacyV4Record')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cnas');
    }
};
