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
        Schema::create('tenant_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants');
            $table->string('title');
            $table->longText('description');
            $table->enum('type',['yearly','monthly']);
            $table->bigInteger('duration');
            $table->bigInteger('amount');
            $table->bigInteger('discount');
            $table->bigInteger('total');
            $table->enum('status',['active','inactive','expired']);
            $table->date('activation_date')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_services');
    }
};
