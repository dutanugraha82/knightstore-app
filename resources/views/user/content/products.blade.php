@extends('user.master.index')

@section('content')

@if(session('success'))
<div class="alert alert-outline-white shadow-sm alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
        </div>
        <div class="ms-3">
            <h6 class="mb-0 text-white">Sukses!</h6>
            <div>{{ session('success') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
    @foreach ($data as $item)
    <div class="col-6">
        <a href="/detail-product/{{ $item->id }}">
            <div class="card p-3">
                <img src="{{ asset('/storage/public'.'/'.$item->img) }} " class="card-img-top" alt="...">
                <div class="card-body">
                    <h6 class="card-title cursor-pointer">{{ $item->nama }}</h6>
                    <div class="clearfix mb-3">
                        <p class="mb-0 float-start">Rarity : {{ $item->rarity }}</p><br>
                        <p class="mb-0 float-start fw-bold">@currency($item->harga)</p>    
                    </div>
                   
                    <small class="float-end">stok : {{ $item->qty }}</small>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>    
@endsection