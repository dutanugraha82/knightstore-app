@extends('user.master.index')

@section('breadcrumbs')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">eCommerce</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Products Details</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
@foreach ($carts as $cart)
<div class="mt-5">
    <div class="row justify-content-center">
        <div class="card p-3 col-lg-6">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('/storage/public'.'/'.$cart->gambarBarang->img) }}" alt="..." class="card-img">
                    <input type="hidden" value="{{ csrf_token($cart->id) }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $cart->gambarBarang->barang->nama }}</h5>
                        <p class="card-text d-none d-md-block">{{ $cart->gambarBarang->barang->deskripsi }}</p>
                        <div class="d-flex mt-4 mt-md-0 justify-content-between gap-3 px-2">
                            <div class="input-group input-spinner w-75">
                                <input type="text" class="form-control text-center" value="{{ $cart->qty }}">
                            </div>
                                <form action="/cart/{{ $cart->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger btn-md">
                                    <i class="bx bx-trash"></i>
                                </button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
@endforeach

<div class="row justify-content-center my-4">
    {{-- <button type="button" class="btn btn-light px-5 col-lg-6 radius-30">Pesan sekarang</button> --}}
    <a href="{{ url('/checkout') }}" class="btn btn-light px-5 col-lg-6 radius-30">Pesan sekarang</a>
</div>
@endsection