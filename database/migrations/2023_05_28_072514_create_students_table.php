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
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('kelas_id')->constrained();
            $table->foreignId('jurusan_id')->constrained();
            $table->string('student_avatar')->nullable();
            $table->string('student_name')->nullable();
            $table->integer('student_nisn')->nullable();
            $table->string('student_class')->nullable();
            $table->string('student_jurusan')->nullable();
            $table->string('phone');
            $table->enum('gender', ['Male', 'Female']);
            $table->text('alamat');
            $table->softDeletes();
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
