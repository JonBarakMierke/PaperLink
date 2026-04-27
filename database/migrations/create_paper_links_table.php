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
        $connection = config('request-analytics.database.connection');

        Schema::connection($connection)->create('paper_links', function (Blueprint $table) {
            $table->id();

            $table->string('slug')->unique();
            $table->string('destination_url');

            $table->string('title')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_paid')->default(false);
            $table->date('paid_access_until')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paper_links');
    }
};
