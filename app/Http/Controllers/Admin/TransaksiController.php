<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index(){
        return view('admin.content.transaksi.index');
    }

    public function json(){
        // $data = Transaksi::where('status','=',null)->select('users_id')->distinct()->get();
        $data = Transaksi::where('status','=',null)->select('users_id','bukti','total','created_at','kode_transaksi')->distinct()->get();
        // dd($data);
        return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return  '<a href="/superadmin/transaksi/'.$data->kode_transaksi.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
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
        $data = Transaksi::where('status','=','proses');
        
        if (auth()->user()->role == 'superadmin') {
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

        }  elseif(auth()->user()->role == 'admin') {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return  '<a href="/admin/transaksi/'.$data->id.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
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
                
    }

    public function successJson(){
        $data = Transaksi::where('status','=','success')->select('users_id','bukti','total','created_at','kode_transaksi')->distinct()->get();
        if (auth()->user()->role == 'superadmin') {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return  '<a href="/superadmin/transaksi/'.$data->kode_transaksi.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
                })
                ->addColumn('users', function($data){
                    return $data->user->name;
                })
                ->rawColumns(['action','users'])
                ->make(true);

        } elseif (auth()->user()->role == 'admin') {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return  '<a href="/admin/transaksi/'.$data->kode_transaksi.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
                })
                ->addColumn('users', function($data){
                    return $data->user->name;
                })
                ->rawColumns(['action','users'])
                ->make(true);
        } 
        
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
        
        $kode = Str::random(7);
        foreach ($data as $item) {
           Transaksi::create([
                'users_id' => auth()->user()->id,
                'barang_id' => $item->barang_id,
                'total' => $total,
                'bukti' => $request->file('bukti')->store('bukti'),
                'qty' => $item->qty,
                'kode_transaksi' => $kode
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

    public function detail($kode_transaksi){
        $data = Transaksi::where('kode_transaksi','=',$kode_transaksi)
                ->get();
        $status = [];
        $dataStatus = DB::table('transaksi')->where('kode_transaksi','=',$kode_transaksi)->select('status')->distinct()->get('status');
        foreach ($dataStatus as $item) {
            $status ['status'] = $item->status; 
        }
        // dd($status);
        return view('admin.content.transaksi.detail', compact('data','status'));
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

        Transaksi::where('kode_transaksi','=',$request->kode_transaksi)->update([
            'status' => 'proses',
            'resi' => $request->resi
        ]); 

        return redirect('/superadmin/transaksi');

        // dd($transaksi);
      
    }

    public function tBerlangsung(){
        return view('admin.content.transaksi.berlangsung');
    }


    public function tSelesai(){
        return view('admin.content.transaksi.selesai');
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
        $kode = Str::random(7);
        // dd($kode);
         Transaksi::create([
            'users_id' => auth()->user()->id,
            'barang_id' => $request->barang,
            'total' => decrypt($request->sub),
            'qty' => $request->qty,
            'bukti' => $request->file('bukti')->store('bukti'),
            'kode_transaksi' => $kode
        ]);

        DB::table('barang')->where('id','=',$request->barang)
                            ->update([
                                'qty' => $updateQty
                            ]);

        return redirect('/');

    }

    public function transaksiSaya($id){
        $data = DB::table('barang')
                    ->join('transaksi','barang.id','=','transaksi.barang_id')
                    ->where('transaksi.users_id','=',$id)
                    ->where('transaksi.status','=','proses')
                    ->distinct()->get(['resi','total','transaksi.created_at','transaksi.qty','barang.nama','kode_transaksi']);
                    
        return view('user.content.transaksi', compact('data'));
    }

    public function transaksiSelesai($kode){
        DB::table('transaksi')->where('kode_transaksi','=',$kode)->update(['status'=>'success']);
        return back();
    }
}
