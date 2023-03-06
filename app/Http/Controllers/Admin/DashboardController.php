<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){

        $tm = DB::table('pesanan')->whereMonth('updated_at','=', date('m'))->whereYear('updated_at','=', date('Y'))->count();
        $pendapatan = DB::table('pesanan')->whereMonth('updated_at','=', date('m'))->whereYear('updated_at','=', date('Y'))->sum('total_harga');
        $users = DB::table('users')->where('role','=','user')->count();
        $jan = DB::table('pesanan')->whereMonth('updated_at','=', date('01'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $feb = DB::table('pesanan')->whereMonth('updated_at','=', date('02'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $mar = DB::table('pesanan')->whereMonth('updated_at','=', date('03'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $apr = DB::table('pesanan')->whereMonth('updated_at','=', date('04'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $may = DB::table('pesanan')->whereMonth('updated_at','=', date('05'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $june = DB::table('pesanan')->whereMonth('updated_at','=', date('06'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $july = DB::table('pesanan')->whereMonth('updated_at','=', date('07'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $aug = DB::table('pesanan')->whereMonth('updated_at','=', date('08'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $sept = DB::table('pesanan')->whereMonth('updated_at','=', date('09'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $oct = DB::table('pesanan')->whereMonth('updated_at','=', date('10'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $nov = DB::table('pesanan')->whereMonth('updated_at','=', date('11'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        $dec = DB::table('pesanan')->whereMonth('updated_at','=', date('12'))->whereYear('updated_at','=',date('Y'))->sum('total_harga');
        
        return view('admin.content.dashboard',compact('tm','pendapatan','users','jan','feb','mar','apr','may','june','july','aug','sept','oct','nov', 'dec'));
    }
}
