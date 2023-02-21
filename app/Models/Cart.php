<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $fillable = ['user_id','barang_id','qty','subtotal','gambar_barang_id','created_at','updated_at'];


    public function barang(){
        return $this->belongsTo(Barang::class,'barang_id');
    }

    public function gambarBarang(){
        return $this->belongsTo(GambarBarang::class,'gambar_barang_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
