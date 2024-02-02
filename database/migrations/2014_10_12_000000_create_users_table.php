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
<<<<<<< HEAD
            $table->string('role');
            $table->integer('phone')->nullable();
=======
            $table->foreignId('role_id')->constrained('roles')->restrictOnDelete();
            $table->integer('phone');
>>>>>>> 5a217196c20bc89afb82fe51ace72244b2afb1ed
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
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
