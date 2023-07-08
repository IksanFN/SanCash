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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('bill_id')->constrained();
            $table->string('payment_status')->nullable()->default('Belum Bayar');
            $table->boolean('is_paid')->default(false);
            $table->date('payment_date')->nullable();
            $table->enum('payment_method', ['Manual', 'Otomatis'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
