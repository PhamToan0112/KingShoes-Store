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
            $table->text('description')->nullable(); // Mô tả chi tiết về sản phẩm
            $table->decimal('price', 10);
            $table->decimal('price_sale', 10)->nullable(); // Giá khuyến mãi, nếu có
            $table->unsignedInteger('stock')->default(0); // Số lượng tồn kho
            $table->unsignedInteger('view')->default(0);
            $table->unsignedInteger('quantity')->default(0); // Số lượng của sản phẩm
            $table->enum('status', ['active','inactive'])->default('active'); // Trạng thái của sản phẩm
            $table->unsignedBigInteger('category_id'); // Khóa ngoại đến bảng danh mục
            $table->string('image')->nullable(); // Ảnh chính của sản phẩm
            $table->json('additional_images')->nullable(); // Các ảnh phụ của sản phẩm
            $table->unsignedInteger('sort_order')->default(0); // Thứ tự hiển thị sản phẩm
            $table->timestamps(); // Tự động tạo created_at và updated_at
        
            // Định nghĩa khóa ngoại
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
