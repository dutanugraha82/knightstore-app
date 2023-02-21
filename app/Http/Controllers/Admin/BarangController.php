<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\GambarBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.content.barang.index');
    }

    public function json(){
        $barang = Barang::all();
        // for superadmin
        if (auth()->user()->role == 'superadmin') {
            return datatables()->of($barang)
                ->addIndexColumn()
                ->addColumn('action',function($barang){
                    return '<a href="/superadmin/barang/'.$barang->id.'/edit" class="btn btn-warning btn-sm">Sunting</a>
                            <a href="/superadmin/barang/'.$barang->id.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
         // for admin
        } elseif (auth()->user()->role == 'admin') {
            return datatables()->of($barang)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    return '<a href="/admin/barang/'.$row->id.'/edit" class="btn btn-warning btn-sm">Sunting</a>
                            <a href="/admin/barang/'.$row->id.'"class="btn btn-primary btn-sm ml-3">Detail</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.barang.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'rarity' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        ]);

        $data = Barang::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'rarity' => $request->rarity,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'qty' => $request->qty,
            'harga' => $request->harga,
        ])->id;

            $image = $request->file('image');
            $file = [];
            foreach($image as $img){
                $file[] = $img->store('gambar-barang');
            }
            foreach($file as $img){
            GambarBarang::create([
                'img' => $img,
                'barang_id' => $data
            ]); 
            
        }
        if (auth()->user()->role == 'superadmin') {
            return redirect('/superadmin/barang');

        } elseif(auth()->user()->role == 'admin') {
            return redirect('/admin/barang');
        }
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        $gambar = GambarBarang::where('barang_id',$id)->get();
        return view('admin.content.barang.show',compact('barang','gambar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        $gambar = GambarBarang::where('barang_id',$id)->get();
        // dd($gambar);
        return view('admin.content.barang.edit',compact('barang','gambar'));
    }

    public function editGambar($id){
        $gambar = GambarBarang::find($id);
        return view('admin.content.barang.edit-gambar',compact('gambar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'rarity' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        ]);

        Barang::find($id)->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'rarity' => $request->rarity,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'qty' => $request->qty,
            'harga' => $request->harga,
        ]);
        if($request->img){
            GambarBarang::create([
                'img' => $request->file('img')->store('gambar-barang'),
                'barang_id' => $id
            ]);
        }
         if (auth()->user()->role == 'superadmin') {
            return redirect('/superadmin/barang/'.$id.'/edit');
         } elseif(auth()->user()->role == 'admin') {
            return redirect('/admin/barang/'.$id.'/edit');
         }
           
           
    }

    public function updateGambar(Request $request, $id){
        $request->validate([
            'img' => 'image'
        ]);
        Storage::delete($request->oldImage);
        GambarBarang::where('id',$id)->update([
            'img' => $request->file('img')->store('gambar-barang')
        ]);
        
        if (auth()->user()->role == 'superadmin') {
            return redirect('/superadmin/barang/'.$id.'/img');
        } elseif(auth()->user()->role == 'admin') {
            return redirect('/admin/barang/'.$id.'/img');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $files = $request->image;
        // dd($files);
        GambarBarang::where('barang_id',$id)->delete();
        Barang::find($id)->delete();
        foreach($files as $item){
            Storage::delete($item);
        }

        if (auth()->user()->role == 'superadmin') {
            return redirect('/superadmin/barang');
        } elseif(auth()->user()->role == 'admin') {
            return redirect('/admin/barang');
        }
        
        
    }

    public function destroyGambar(Request $request, $id){
        GambarBarang::find($id)->delete();
        Storage::delete($request->img);

        if (auth()->user()->role == 'superadmin') {
            return redirect('/superadmin/barang/'.$request->barang.'/edit');
        } elseif(auth()->user()->role == 'admin') {
            return redirect('/admin/barang/'.$request->barang.'/edit');
        }
        
        
    }

}
