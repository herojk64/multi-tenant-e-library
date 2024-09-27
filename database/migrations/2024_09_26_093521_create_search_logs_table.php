<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchLogsTable extends Migration
{
    public function up()
    {
        Schema::create('search_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Store user ID (nullable for guests)
            $table->string('query'); // Store the search term
            $table->ipAddress('ip_address'); // Store user's IP address
            $table->timestamp('searched_at'); // Track when the search was made
            $table->timestamps();

            // Foreign key for user if they are logged in
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('search_logs');
    }
}

