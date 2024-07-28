<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['comment_content', 'comment_name', 'comment_product_id'];
    public function scopeShow_comment($query,$product_id){
        return $query->where('comment_product_id',$product_id)->get();
    }
    public function scopeCheckComment($query){
        return $query->orderBy('id','desc')->get();
    }
    public function product()
    {
        return $this->belongsTo(Products::class, 'comment_product_id', 'id');
    }
}
