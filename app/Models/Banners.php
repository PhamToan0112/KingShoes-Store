<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;
    public function scopeBanner($query){
        return $query->orderBy('sort_order','ASC');
    }
    public function scopeView_banner($query){
        return $query->where('status','=','active')->get();
    }
    protected $fillable = [        
        'id',  'name', 'image','description','sort_order','status',
    ];
}
