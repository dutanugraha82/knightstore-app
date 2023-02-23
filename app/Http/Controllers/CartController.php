<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::where('user_id','=',auth()->user()->id)->get();
        // dd($stock);

        return view('user.content.cart', compact('carts'));
        
    }

    public function store(Request $request){
        if($request->qty == 0){
            return back()->with('error','Jumlah barang belum ditambahkan!');;
        }
        // dd($request->id);
        $gambar_barang_id = decrypt($request->gambar);
        $subtotal = $request->sub * $request->qty;
        Cart::create([
            'user_id' => Auth::user()->id,
            'barang_id' => $request->id,
            'gambar_barang_id' => $gambar_barang_id,
            'qty' => $request->qty,
            'subtotal' => $subtotal,
        ]);

        return redirect()->route('product')->with('success','Barang berhasil ditambahkan ke keranjang!');
    }

    public function destroy($id){
        // dd($id);
        DB::table('cart')->where('id','=',$id)->delete();
        return redirect('/cart');
    }
}
