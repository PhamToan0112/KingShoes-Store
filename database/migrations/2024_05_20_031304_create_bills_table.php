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
            $table->string('order_code')->unique(); // Mã đơn hàng 
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->string('name_cus'); // Tên người đặt
            $table->string('email_cus')->nullable(); // Email người đặt
            $table->string('sdt_cus'); // Số điện thoại người đặt
            $table->string('diachi_cus')->nullable(); // Địa chỉ người đặt
            $table->integer('total'); // Tổng tiền
            $table->integer('ship'); // Phí vận chuyển
            $table->integer('voucher')->nullable(); // Mã giảm giá (có thể rỗng)
            $table->integer('sub_total'); // Tổng tiền sau khi giảm giá
            $table->tinyInteger('payment_method'); // Phương thức thanh toán
            $table->timestamps();

            // Thêm khóa ngoại nếu cần
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
