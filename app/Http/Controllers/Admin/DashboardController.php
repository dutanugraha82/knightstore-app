<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){

        $tm = DB::table('pesanan')->count();
        $pendapatan = DB::table('pesanan')->sum('total_harga');
        $users = DB::table('users')->where('role','=','user')->count();
        // dd($pendapatan);
        
        return view('admin.content.dashboard',compact('tm','pendapatan','users'));
    }
}
