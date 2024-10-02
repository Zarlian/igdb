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
        Schema::create('games_language', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('game_id');
            $table->string('language');
            $table->string('short_description');
            $table->text('long_description');
            $table->timestamps();

            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games_language');
    }
};
