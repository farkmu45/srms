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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('matrix', 12)->unique();
            $table->unsignedTinyInteger('semester');
            $table->date('date_of_birth');
            $table->string('parent_name', 200);
            $table->string('phone_number', 15);
            $table->string('parent_phone_number', 15);
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
        Schema::dropIfExists('students');
    }
};
