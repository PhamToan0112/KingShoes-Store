<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Products extends Model
{
    use HasFactory;

    public function scopeProductNews($query)
    {
        return $query
                    ->where('status', 'active')
                    ->orderBy('created_at', 'desc')
                    ->with(['category','productSizes'])
                    ->limit(8)
                    ->get();
    }

    public function scopeProductHot($query)
    {
        return $query
        ->where('status', 'active')
        ->where('view','>',50)
        ->orderBy('created_at', 'desc')
        ->with(['category','productSizes'])
        ->limit(8)->get();
    }

    public function scopeProductAll($query)
    {
        return $query
        ->where('status','active')
        ->orderBy('id', 'desc')
        ->with('category')->get();
    }

    public function scopeProductBycate($query,$cate_id){
        return $query
        ->where('status','active')
        ->orderBy('id','desc')
        ->with(['category','productSizes'])
        ->where('id',$cate_id);
    }

    public function scopeProductDetail($query,$slug){
        return $query
        ->where('slug',$slug)
        ->orderBy('id','desc')
        ->with(['category','productSizes']);
    }
    public function scopeRelatedProduct($query,$product_detail){
        return $query
        ->where('status','active')
        ->where('category_id',$product_detail->category_id)
        ->with(['category','productSizes'])
        ->orderBy('id','desc')
        ->limit(4);
    }

    public function scopeA_products($query)
    {
        return $query->orderBy('id', 'desc');
    }


    protected $fillable = [
        'name', 'price', 'image', 'description', 'price_sale', 
        'stock', 'view', 'status', 'category_id', 'additional_images', 'sort_order' ,'slug'
    ];

 
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
   
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function productSizes()
    {
        return $this->hasMany(Product_sizes::class, 'product_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comments::class, 'comment_product_id', 'id');
    }
}
