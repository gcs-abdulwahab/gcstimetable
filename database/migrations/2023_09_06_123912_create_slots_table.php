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
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            // create unique slot code
            $table->string('code');
            // slot name
            $table->string('name');
            // slot starting time 
            $table->time('start_time');
            // slot ending time
            $table->time('end_time');
            
            $institution_id = 1;
            // belongs to some institution
            $table->foreignId('institution_id')->default($institution_id)->constrained()->onDelete('cascade');

            // Define a unique constraint for 'code' and 'institution_id' combination
            $table->unique(['code', 'institution_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
