<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryApi extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name','image','parent_id','status' ,'description', 'sort_order', 'name_cate_Url'];
    public static function getCategory(){
        return self::orderBy('id', 'desc')->limit(6)->get();
    }
}
