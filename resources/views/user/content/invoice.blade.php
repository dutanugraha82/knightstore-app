@extends('user.master.index')

@section('breadcrumbs')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">eCommerce</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Invoice</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="col-xs-auto  mx-auto my-5 border rounded p-4" style="position: relative;">
    <div class="row justify-content-between align-items-center">
        <h6 class="col-6">Invoice #23013692 <span class="badge  bg-warning">Belum dibayar</span></h6>
        <p class="col-6 text-end">19 Januari 2023 8:16 pm</p>
    </div>
    <hr>
    <p>Dikirim ke :</p>    
    <div class="col-xs-auto border p-2">
        <h4>Rumah</h4>
        <p>Muhamad Haidar Ijlal</p>
        <span>Kab. Karawang, CikampekJawa Barat, Indonesia</span>
        <p>+62 876 6765 7656</p>
        <span>JNE - REG</span>
        <hr>
        <h4 class="text-center">Menunggu untuk di Kirim</h4>
    </div>
    <div class="col-xs-auto mt-5">
        <div class="row justify-content-between mx-2">
            <table>
                <thead>
                    <tr>
                        <th><h5>Subtotal</h5></th>
                        <td class="text-end"><h6>150.000</h6></td>
                    </tr>
                    <tr>
                        <th>
                            <small><i>Tarif pengiriman</i></small>
                            <p>JNE REGULER</p>
                        </th>
                        <td class="text-end"><h6>10.000</h6></td>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-top: 1px solid rgb(240, 240, 240); border-collapse:separate;">
                        <th><h4>Total</h4></th>
                        <td class="text-end"><h4>150.000</h6></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mt-5 text-end">
            <div class="col-12">
                <button type="button" class="btn btn-outline-danger px-3 radius-30">Cancel</button>
                <a href="{{ url('/konfirmasi/pembayaran') }}" class="btn btn-primary px-3 radius-30">Upload bukti</a>
            </div>
        </div>
    </div>
</div>
@endsection