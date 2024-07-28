<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsApi extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name', 'price', 'image', 'description', 'price_sale', 
        'stock', 'view', 'status', 'category_id', 'additional_images', 'sort_order'
    ];
    
    public static function getLatestProducstModel(){
        return self::orderBy('created_at', 'desc')->limit(6)->get();
    }
    public static function getProductsHot(){
        return self::where('view','>',50)->orderBy('created_at', 'desc')->limit(6)->get();
    }
}
