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
        Schema::create('game_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('game_id')->constrained();
            $table->integer('rating');
            $table->text('review')->nullable();
            $table->timestamps();


            $table->unique(['user_id', 'game_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('game_id')->references('id')->on('games');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_user');
    }
};
