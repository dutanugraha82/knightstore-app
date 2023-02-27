<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.content.pengguna.index');
    }

    public function user(){
        return view('admin.content.pengguna.user');
    }

    public function jsonUser(){
        $data = User::where('role','=','user');
        return datatables()->of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($data){
                                return '<a href="/superadmin/pengguna/'.$data->id.'"class="btn btn-primary ml-3">Detail</a>';
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }

    public function jsonAdmin(){
        $data = User::where('role','=','admin');
        return datatables()->of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($data){
                                return '<a href="/superadmin/pengguna/'.$data->id.'"class="btn btn-primary ml-3">Detail</a>';
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama' => 'required',
            'nohp' => 'required',
            'email' => 'email|required',
            'password' => 'required',
            'foto' => 'image',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        // dd($request);

        if($request->file('foto')){
            User::create([
                'name' => $request->nama,
                'nohp' => $request->nohp,
                'email'=> $request->email,
                'password' => Hash::make($request->password),
                'foto' => $request->file('foto')->store('foto-profile'),
                'alamat' => $request->alamat,
                'role' => $request->role,
            ]);
        }

        return redirect('/superadmin/pengguna/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function userShow($id){
        $data = User::find($id);
        return view('admin.content.pengguna.detail-user', compact('data'));
    }

    public function show($id)
    {
        $data = User::find($id);
        // dd($data);
        return view('admin.content.pengguna.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.content.pengguna.edit',compact('data'));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('user.content.user-profile', compact('user'));
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
        // dd($request);
        $request->validate([
            'name' => 'required',
            'nohp' => 'required',
            'email' => 'email|required',
            'foto' => 'image',
            'alamat' => 'required',
        ]);
        // dd($request->oldImage);

        if ($request->file('foto')) {
            Storage::delete($request->oldImage);
            User::find($id)->update([
                'name' => $request->name,
                'nohp' => $request->nohp,
                'email'=> $request->email,
                'foto' => $request->file('foto')->store('foto-profile'),
                'alamat' => $request->alamat,
            ]);
            
        } 
        else {
            User::find($id)->update([
                'name' => $request->name,
                'nohp' => $request->nohp,
                'email'=> $request->email,
                'alamat' => $request->alamat,
            ]);
        }

        if (auth()->user()->role == 'superadmin') {
            return redirect('/superadmin/pengguna/'.$id);
        } elseif(auth()->user()->role == 'admin') {
            return redirect('/admin/pengguna/'.$id);
        }elseif(auth()->user()->role == 'user'){
            return redirect('/user-profile'.'/'.$id);
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
        if ($request->file('foto')) {
            Storage::delete($request->foto);
            User::find($id)->delete();
        } else {
            User::find($id)->delete();
        }

        return redirect('/superadmin/pengguna/admin');
        

    }
}
