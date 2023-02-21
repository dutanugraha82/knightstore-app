<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarBarang extends Model
{
    use HasFactory;
    protected $table = 'gambar_barang';
    protected $fillable = ['img','barang_id'];
    protected $dates = ['created_at'];

    public function barang(){
     return $this->belongsTo(Barang::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
