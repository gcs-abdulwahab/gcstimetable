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
            $table->string('name')->unique();
        
            // create a unique code for each room
            $table->string('code')->unique();
            $table->integer ('capacity');
            // create a column so it could be either Intermediate , BS or both   enum
            $table->enum('type', ['intermediate', 'bs','both']);
            // isavailable
            $table->boolean('isavailable');
            
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
