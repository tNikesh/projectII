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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->string('number');
            $table->string('email');
            $table->string('province');
            $table->string('district');
            $table->string('city');
            $table->string('street');
            $table->string('payment_status');
            $table->string('delivery_status')->default('pending');
            $table->decimal('grand_total', 10, 2);
            $table->timestamps();

            // Foreign key constraints (optional but recommended)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
