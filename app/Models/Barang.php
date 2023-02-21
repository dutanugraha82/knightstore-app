<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = 
    ['nama','kode','rarity','kategori','deskripsi','qty','harga'];
    protected $dates = ['created_at'];

    protected function gambar(){
       return $this->hasMany(GambarBarang::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
