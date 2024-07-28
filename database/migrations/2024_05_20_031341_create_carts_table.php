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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Thêm cột tên (string)
            $table->decimal('price', 10, 2); // Thêm cột giá (decimal)
            $table->string('image'); // Thêm cột hình (string)
            $table->unsignedInteger('quantity')->default(0); // Số lượng của sản phẩm
            $table->unsignedBigInteger('idsp');
            $table->unsignedBigInteger('idbill'); // Thêm cột id bill (unsignedBigInteger)
            $table->timestamps();

            $table->foreign('idsp')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('idbill')->references('id')->on('bills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
