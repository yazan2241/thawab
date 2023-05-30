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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('password');
            $table->string('father_alive')->nullable();
            $table->integer('father_age')->nullable();
            $table->string('father_job')->nullable();
            $table->string('father_disease')->nullable();
            $table->string('mother_alive')->nullable();
            $table->string('mother_age')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('mother_disease')->nullable();
            $table->string('boys')->nullable();
            $table->string('girls')->nullable();
            $table->integer('capicity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
