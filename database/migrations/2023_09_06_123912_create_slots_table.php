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

            // isPractical is by default false
            $table->boolean('is_practical')->default(false);

            // slot can be of isMorning which is by default true
            $table->boolean('is_morning')->default(true);
            
            $institution_id = 1;
            // belongs to some institution
            $table->foreignId('institution_id')->default($institution_id)->constrained()->onDelete('cascade');

            // Define a unique constraint for 'code' and 'institution_id' combination
            $table->unique(['code', 'institution_id' , 'is_morning']);

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
