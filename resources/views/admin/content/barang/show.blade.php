@extends('admin.master.index')
@section('content')
    <div class="container">
        <div class="card p-2">
                <h3 class="mb-3">{{ $barang->nama }}</h3>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2">Kode Barang : {{ $barang->kode }}</p>
                            <p class="mb-2">Rarity : {{ $barang->rarity }}</p>
                            <p>Harga:<b>Rp {{ $barang->harga }}</b></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">Kategori : {{ $barang->kategori }}</p>
                            <p class="mb-2">Stok : {{ $barang->qty }}</p>
                            <p class="mb-2">Tanggal Masuk : {{ $barang->created_at }}</p>
                        </div>
                    </div>
                </div>
                <div class="container">
                @if (auth()->user()->role == 'superadmin')
                    <form action="/superadmin/barang/{{ $barang->id }}" method="POST">
                @elseif(auth()->user()->role == 'admin')
                    <form action="/admin/barang/{{ $barang->id }}" method="POST">
                @endif
                        @csrf
                        @method('delete')
                        <div class="row">
                            @foreach ($gambar as $item)
                            <div class="col-md-4">
                                <div class="mb-3 card p-2">
                                    <img class="col-5 mx-auto rounded mb-3"  src="{{ asset('/storage/public'.'/'.$item->img) }}" alt="">
                                    <input type="hidden" name="image[]" value="{{ $item->img }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="my-4 d-flex">
                            @if (auth()->user()->role == 'superadmin')
                                <a href="/superadmin/barang" style="width:120px" class="btn btn-warning d-block me-auto">Kembali</a>
                            @elseif(auth()->user()->role == 'admin')
                                <a href="/admin/barang" style="width:120px" class="btn btn-warning d-block me-auto">Kembali</a>
                            @endif
                            <button type="submit" class="btn btn-danger d-block ms-auto" onclick="return confirm('Apakah yakin ingin menghapus data {{ $barang->nama }}');">Hapus Data</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
@endsection