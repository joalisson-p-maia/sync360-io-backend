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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('profile')->nullable();
            $table->integer('age');
            $table->string('full_name')->nullable(false);
            $table->string('street')->nullable(false);
            $table->string('neighborhood')->nullable(false);
            $table->string('state')->nullable(false);
            $table->string('biography')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};