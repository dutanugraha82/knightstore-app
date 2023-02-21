<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['users_id','barang_id','total','status','bukti','qty','created_at','updated_at'];
    protected $dates = ['created_at'];

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

    public function barang(){
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
