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
        Schema::create('vounchers', function (Blueprint $table) {
            $table->id();

            $table->string('customer');
            $table->string('vouncher_number');

            $table->integer('total');
            $table->integer('tax');
            $table->integer('net_total');

            $table->foreignId('user_id');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vounchers');
    }
};
