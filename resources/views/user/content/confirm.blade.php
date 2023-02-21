@extends('user.master.index')

@section('breadcrumbs')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">eCommerce</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Konfirmasi pembayaran</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="col-8 mx-auto">
    <div class="card border-top border-0 border-4 border-white">
        <div class="card-body p-5">
            <div class="card-title d-flex align-items-center justify-content-center">
                <div><i class="bx bx-money-withdraw me-1 font-22 text-white"></i>
                </div>
                <h5 class="mb-0 text-white">Konfirmasi Pembayaran</h5>
            </div>
            <hr>
            <form class="row g-3">
                <div class="col-md-12">
                    <h4>23014163</h4>
                </div>
                <div class="col-md-12">
                    <label for="tanggal-pembayaran" class="form-label">Tanggal pembayaran</label>
                    <input name="tanggal-pembayaran" type="date" class="form-control" id="tanggal-pembayaran">
                </div>
                <div class="col-md-12">
                    <label for="transfer" class="form-label">Ditransfer ke</label>
                    <h5>BCA - 099882122 - Jhon Doe</h5>
                </div>
                <div class="col-md-12">
                    <label for="bank-asal" class="form-label">Bank asal</label>
                    <input name="bank-asal" type="text" class="form-control" id="bank-asal">
                </div>
                <div class="col-md-12">
                    <label for="pemilik" class="form-label">Pemilik bank</label>
                    <input name="pemilik" type="text" class="form-control" id="pemilik">
                </div>
                <div class="col-md-12">
                    <label for="nominal" class="form-label">Nominal</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input name="nominal" type="text" class="form-control border-start-0" id="nominal">
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="bukti" class="form-label">Bukti pembayaran</label>
                    <input name="bukti" class="form-control" id="bukti" type="file">
                </div>

                <div class="col-12 mt-5">
                    <a href="{{ url('/invoice') }}" class="btn btn-light w-100">Konfirmasi</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection