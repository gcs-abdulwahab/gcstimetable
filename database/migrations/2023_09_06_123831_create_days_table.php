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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            // day number
            $table->integer('number');
            // day name
            $table->string('name');
            // day code
            $table->string('code');

            $institution_id = 1;
            // belongs to some institution
            $table->foreignId('institution_id')->default($institution_id)->constrained()->onDelete('cascade');

            // unique constraint of code and institution_id
            $table->unique(['code', 'institution_id']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
