<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $connection = config('request-analytics.database.connection');

        Schema::connection($connection)->create('linkables', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paper_link_id')
                ->constrained('paper_links')
                ->cascadeOnDelete();

            $table->morphs('linkable');

            $table->timestamps();
        });
    }

    public function down()
    {
        $connection = config('request-analytics.database.connection');

        Schema::connection($connection)->dropIfExists('linkables');
    }
};
