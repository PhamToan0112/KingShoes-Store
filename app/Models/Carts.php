<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','size','price', 'image', 'quantity', 
        'idsp', 'idbill'
    ];

    public function productSize()
    {
        return $this->belongsTo(Product_sizes::class, 'idsize', 'id');
    }
    public function products()
    {
        return $this->belongsTo(Products::class, 'idsp', 'id');
    }
    public function bills()
    {
        return $this->belongsTo(Bills::class, 'idbill', 'id');
    }
}
