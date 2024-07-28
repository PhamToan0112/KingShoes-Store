<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_sizes extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'size', 'stock'];

    // Định nghĩa mối quan hệ ngược lại với Product
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

}

