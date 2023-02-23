@extends('user.master.index')
@section('content')
   @foreach ($data as $item)
   <div class="card mx-auto" style="max-width: 500px">
    <div class="card-body">
        <h5 class="card-title">No Resi : {{ $item->resi }}</h5>
        <p class="card-text">Total Harga: @currency($item->total_harga)</p>
      <form action="/transaksi/{{ $item->resi }}/selesai" method="POST">
        @method('put')
        @csrf
        <button type="submit" class="btn btn-warning w-100" onclick="return confirm('Anda Yakin Ingin Selesaikan Transaksi ?')">Barang Diterima</button>
    </form>
    </div>
  </div>
   @endforeach
@endsection