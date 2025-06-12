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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('original_title')->nullable();
            $table->string('poster_url')->nullable();
            $table->year('release_year');
            $table->text('description')->nullable();
            $table->string('original_language', 5)->nullable();
            //$table->enum('status', ['Assistido', 'Para ver', 'Abandonado']);
            $table->string('tmdb_id')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
