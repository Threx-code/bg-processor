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
            $table->string('key')->unique()->index();
            $table->uuid('assignerOrgId')->nullable()->index();
            $table->string('title')->nullable()->index();
            $table->string('state')->nullable()->index();
            $table->string('assignerShortName')->nullable();
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
