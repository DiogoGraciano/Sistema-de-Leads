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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->dateTime('date');
            $table->foreignId('hotel_id')->constrained('hotels');
            $table->string('email');
            $table->string('nr_room');
            $table->enum('question', ['1 vez ao ano', '2 vezes ao ano', '3 vezes ou mais ao ano', 'É a minha primeira vez']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
