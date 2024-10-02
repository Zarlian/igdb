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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('release_date');
            $table->string('cover');
            $table->string('esrb_rating');
            $table->unsignedInteger('developer_id');
            $table->boolean('featured')->default(false);
            $table->decimal('average_rating', 2, 2)->default(0);
            $table->unsignedInteger('rating_count')->default(0);
            $table->timestamps();


            $table->foreign('developer_id')
                ->references('id')
                ->on('developers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
