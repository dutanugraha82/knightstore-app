@extends('user.master.index')
@section('content')

@if (!$data->isEmpty())
@foreach ($data as $item)
@if($loop->first)
<div class="card mx-auto" style="max-width: 500px">
 <div class="card-body">
     <h5 class="card-title">No Resi : {{ $item->resi }}</h5>
     <p class="card-text">Total Harga: @currency($item->total)</p>
   @endif
 @endforeach
 <p> Barang : </p>
 @foreach ($data as $item)
 <div class="d-flex gap-1">
   <p class="card-text">{{ $item->nama }} = </p>
   <p class="card-text">{{ $item->qty }} pcs</p>
 </div>
 @endforeach
   @foreach ($data as $item)
   @if ($loop->first)
   <form action="/transaksi/{{ $item->kode_transaksi }}/selesai" method="POST">
     @method('put')
     @csrf
     <button type="submit" class="btn btn-warning w-100" onclick="return confirm('Anda Yakin Ingin Selesaikan Transaksi ?')">Barang Diterima</button>
 </form>
 </div>
 </div>
   @endif
@endforeach
@else
    <h4 class="text-center">Tidak Ada Transaksi</h4>
@endif
@endsection