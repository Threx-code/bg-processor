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
        Schema::create('cves', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid('key')->unique()->index();
            $table->uuid('assignerOrgId')->nullable()->index();
            $table->text('title')->nullable()->index();
            $table->string('state')->nullable()->index();
            $table->string('assignerShortName')->nullable();
            $table->string('dataType')->nullable();
            $table->string('dataVersion')->nullable();
            $table->timestamp('dateReserved')->nullable();
            $table->timestamp('datePublished')->nullable();
            $table->timestamp('dateUpdated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cves');
    }
};
