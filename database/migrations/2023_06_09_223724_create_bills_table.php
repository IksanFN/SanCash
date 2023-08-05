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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            // $table->foreignId('student_id')->nullable();
            $table->foreignId('kelas_id')->constrained();
            $table->foreignId('month_bill_id')->constrained();
            $table->foreignId('week_bill_id')->constrained();
            $table->foreignId('year_id')->constrained();
            $table->string('kelas_name')->nullable();
            $table->string('month_name')->nullable();
            $table->string('week_name')->nullable();
            $table->string('year_name')->nullable();
            $table->date('start_of_week');
            $table->date('end_of_week');
            $table->integer('bill')->unsigned();
            $table->boolean('status')->default(false);
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('student_id')->references('id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
