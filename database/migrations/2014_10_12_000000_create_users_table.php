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
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('dob');
            $table->boolean('isBan')->default(0);
            $table->enum('role', ['admin', 'stuff'])->default('stuff');
            $table->enum('gender', ['male', 'female']);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('otp')->nullable();
            $table->string('photo')->default(config('info.default_contact_photo'));


            // $table->enum('membership', ['planet', 'start', 'moon', 'earth', 'premium', 'pro', 'basic'])->default('basic');
            // $table->enum('gender', ['male', 'female', 'lgbt', 'unselected'])->default('unselected');
            // $table->enum('zodiac',['aries','taurus','gemini','Cancer','Leo','Virgo','Libra','Scorpio','Sagittarius','Capricorn','Aquarius','Pisces']);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
