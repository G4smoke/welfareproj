<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for users
            $table->decimal('amount_paid', 10, 2); // Amount paid
            $table->decimal('amount_owing', 10, 2)->nullable(); // Amount owing (nullable in case not needed)
            $table->enum('status', ['Paid', 'Unpaid']); // Payment status
            $table->string('reference')->unique(); // Unique reference for Paystack transactions
            $table->timestamp('payment_date')->nullable(); // Date the payment was made
            $table->timestamps(); // Laravel timestamps (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};