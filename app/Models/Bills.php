<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users as Users;
class Bills extends Model
{
    use HasFactory;
    public function scopeBillAll($query){
        return $query->orderBy('id','desc');
    }
    protected $fillable = [        
    'id', 'order_code	','user_id','name_cus',	'email_cus','sdt_cus','status',
    'diachi_cus','description','total','ship','voucher','sub_total','payment_method'
    ];
    public function bills()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
    public function carts()
    {
        return $this->hasMany(Carts::class, 'idbill', 'id');
    }
}
