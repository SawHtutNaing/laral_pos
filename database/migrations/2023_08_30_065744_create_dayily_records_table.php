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
        Schema::create('dayily_records', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('month');
            $table->string('year');
            $table->string('total_sell');
            // $table->string('total_quantity');
            // $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dayily_records');
    }
};
