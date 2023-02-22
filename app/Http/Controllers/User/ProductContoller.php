<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\GambarBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductContoller extends Controller
{
     public function index(){
        $data = DB::table('gambar_barang')
                ->join('barang','barang.id','=','gambar_barang.barang_id')
                ->get();
        // dd($data);
        return view('user.content.dashboard', compact('data'));
    }

    public function card(){
        $data = DB::table('gambar_barang')
        ->join('barang','barang.id','=','gambar_barang.barang_id')
        ->where('kategori','=','card')
        ->get();

        return view('user.content.products', compact('data'));
    }

    public function actionFigure(){
       $data = DB::table('gambar_barang')
                ->join('barang','barang.id','=','gambar_barang.barang_id')
                ->where('kategori','=', 'action figure')
                ->get();

        return view('user.content.products', compact('data'));
    }

    public function others(){
      $data =  DB::table('gambar_barang')
        ->join('barang','barang.id','=','gambar_barang.barang_id')
        ->where('kategori','=', 'others')
        ->get();

        return view('user.content.products', compact('data'));
    }

    public function detail($id){
        $data =  DB::table('barang')
                ->where('barang.id','=', $id)
                ->join('gambar_barang','barang.id','=','gambar_barang.barang_id')
                ->get();
        // dd($data);
        return view('user.content.detail-product', compact('data'));
    }
}
