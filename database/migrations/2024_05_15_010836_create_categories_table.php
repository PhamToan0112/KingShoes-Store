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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('name_cate_Url')->nullable(); // Thêm slug cho URL thân thiện
            $table->unsignedBigInteger('parent_id')->nullable(); // Thêm parent_id cho danh mục cha
            $table->enum('status', ['active', 'inactive'])->default('active'); // Thêm status cho quản lý trạng thái
            $table->string('image')->nullable(); // Thêm cột image để lưu URL ảnh đại diện
            $table->integer('sort_order')->default(0); // Thêm sort_order để sắp xếp thứ tự
            $table->timestamps();
            // khóa ngoại của danh mục con 
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
