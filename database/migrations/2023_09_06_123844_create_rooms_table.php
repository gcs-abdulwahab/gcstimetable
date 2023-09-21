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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        
            // create a unique code for each room
            $table->string('code');
            $table->integer ('capacity');
            // create a column so it could be either Intermediate , BS or both   enum
            $table->enum('type', ['intermediate', 'bs','both']);
            // isavailable
            $table->boolean('isavailable');
            

            $institution_id = 1;
            // belongs to some institution
            $table->foreignId('institution_id')->default($institution_id)->constrained()->onDelete('cascade');

            // Define a unique constraint for 'code' and 'institution_id' combination
            $table->unique(['code', 'institution_id']);

            // Define a unique constraint for 'name' and 'institution_id' combination
            $table->unique(['name', 'institution_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
