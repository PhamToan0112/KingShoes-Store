<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['name','image','parent_id','status' ,'description', 'sort_order', 'name_cate_Url'];
    public function scopeCategory($query){
        return $query->where('status','=','active')->get();
    }
    public function scopeA_Categories($query){
        return $query->orderBy('id','desc');
    }

    // Định nghĩa mối quan hệ một-nhiều với Products
    public function products()
    {
        return $this->hasMany(Products::class, 'category_id', 'id');
    }
}
