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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->integer('stock');
            $table->decimal('discount', 5, 2)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('image_1', 255)->nullable(); // File name of the first image
            $table->string('image_2', 255)->nullable(); // File name of the second image
            $table->string('image_3', 255)->nullable(); // File name of the third image
            $table->string('image_4', 255)->nullable(); // File name of the fourth image
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
