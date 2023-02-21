<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Cart;
use App\Models\Pesanan;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(){
        return view('admin.content.transaksi.index');
    }

    public function json(){
        // $data = Transaksi::where('status','=',null)->select('users_id')->distinct()->get();
        $data = Transaksi::where('status','=',null)->select('users_id','bukti','total','created_at')->distinct()->get();

        return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return  '<a href="/superadmin/transaksi/'.$data->users_id.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
                })
                ->addColumn('users', function($data){
                    return $data->user->name;
                })
                ->addColumn('bukti', function($data){
                    return "<a href=".asset('/storage'.'/'.$data->bukti)." target='_blank' rel='noopener noreferrer'>Lihat</a>";
                })
                ->rawColumns(['action','users','bukti'])
                ->make(true);
    }

    public function pendingJson(){
        $data = Transaksi::where('status','=','pending');
        return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return  '<a href="/superadmin/transaksi/'.$data->id.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
                })
                ->addColumn('users', function($data){
                    return $data->user->name;
                })
                ->addColumn('barang',function($data){
                    return $data->barang->nama;
                })
                ->rawColumns(['action','barang','users'])
                ->make(true);
    }

    public function successJson(){
        $data = Transaksi::where('status','=','success');
        return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return  '<a href="/superadmin/transaksi/'.$data->id.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
                })
                ->addColumn('users', function($data){
                    return $data->user->name;
                })
                ->addColumn('barang',function($data){
                    return $data->barang->nama;
                })
                ->rawColumns(['action','barang','users'])
                ->make(true);
    }

    public function create(){
        $query = Cart::where('user_id','=',auth()->user()->id);
        $data = $query->get();
        $total = 12000 + $query->sum('subtotal');
        return view('user.content.checkout',compact('data','total'));
    }

    public function store(Request $request){
       $request->validate([
            'bukti' => 'image',
        ]);

        $query = DB::table('cart')->where('user_id','=',auth()->user()->id);
        $total = 12000 + $query->sum('subtotal');
        
         $barang = $query->get();
        
        $data = [];
        
        foreach ($barang as $item){
            $data[] = $item;
        }
        
        
        foreach ($data as $item) {
            Transaksi::create([
                'users_id' => auth()->user()->id,
                'barang_id' => $item->barang_id,
                'total' => $total,
                'bukti' => $request->file('bukti')->store('bukti'),
                'qty' => $item->qty,
            ]);

            DB::table('t_barang')->insert([
                'users_id' => auth()->user()->id,
                'barang_id' => $item->barang_id,
                'qty' => $item->qty
            ]);
            
           $tBarang = DB::table('t_barang')
                        ->where('users_id','=', auth()->user()->id)
                        ->where('barang_id','=',$item->barang_id)->sum('qty');
           $sql = DB::table('barang')->where('id','=',$item->barang_id);
           $barang = $sql->sum('qty');
           $updateQty = $barang - $tBarang;
           $sql->update([
            'qty' => $updateQty,
           ]);

           DB::table('t_barang')
                        ->where('users_id','=', auth()->user()->id)
                        ->where('barang_id','=',$item->barang_id)
                        ->delete();
        }



        $query->delete();

        return redirect('/');

    
    }

    public function detail($id){
        $data = Transaksi::where('users_id','=',$id)
                ->get();
        // dd($data);
        return view('admin.content.transaksi.detail', compact('data'));
    }

    public function approve(Request $request){
        $request->validate([
            'resi' => 'required'
        ]);

        Pesanan::create([
            'users_id' => $request->user,
            'resi' => $request->resi,
            'total_harga' => $request->total
        ]);

        Transaksi::where('users_id','=',$request->user)->update([
            'status' => 'proses',
            'resi' => $request->resi
        ]); 

        return redirect('/superadmin/transaksi');

        // dd($transaksi);
      
    }

    public function tBerlangsung(){
        return view('admin.content.transaksi.berlangsung');
    }

    public function tBerlangsungJson(){
       $data = Transaksi::where('status','=','proses');

        return datatables()->of($data)
                            ->addIndexColumn()
                            ->addColumn('users', function($data){
                                return $data->user->name;
                            })
                            ->addColumn('barang', function($data){
                                return $data->barang->nama;
                            })
                            ->addColumn('created_at', function($data){
                                return Carbon::parse($data->created_at)->format('d/m/Y');
                            })
                            ->rawColumns(['users','barang'])
                            ->make(true);
    }
    
      public function buyNow(Request $request, $id){
        $sql = DB::table('barang')->where('id','=',$request->id);
        $data = $sql->get();
        $harga = $sql->sum('harga');
        $qty = $request->qtyNow;
        $subtotal = $harga * $qty;
        $total = 12000 + $subtotal;
        return view('user.content.checkout-now', compact('data','qty','total'));
    }

    public function checkoutNow(Request $request){

        $qty = DB::table('barang')->where('id','=',$request->barang)->sum('qty');
        $updateQty = $qty - $request->qty;
        // dd($test);
        Transaksi::create([
            'users_id' => auth()->user()->id,
            'barang_id' => $request->barang,
            'total' => decrypt($request->sub),
            'qty' => $request->qty,
            'bukti' => $request->file('bukti')->store('bukti')
        ]);

        DB::table('barang')->where('id','=',$request->barang)
                            ->update([
                                'qty' => $updateQty
                            ]);

        return redirect('/');

    }
}
