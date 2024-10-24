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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->longText('thumbnail')->nullable();
            $table->string('title')->unique();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('author_name');
            $table->date('published_date')->nullable();
            $table->longText('description')->nullable();
            $table->longText('file');
            $table->enum('type',['free','subscribed'])->default('free');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
