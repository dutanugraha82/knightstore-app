@extends('admin.master.index')
@section('content')
    <div class="container">
        <div class="card p-3">
            @foreach ($data as $item)
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-3">Nama Pemesan : {{ $item->user->name }}</p>
                    <p class="mb-3">Tanggal Pesanan : {{ $item->created_at }}</p>
                    <p class="mb-3">Nama Barang : {{ $item->barang->nama }}</p>
                    <p class="mb3">No Telp : {{ $item->user->phone }}</p>
                    <p class="mb-3">Banyak Barang : {{ $item->qty }}</p>
                    <p class="mb-3">Alamat : {{ $item->user->alamat }}</p>
                </div>

                <div class="col-md-6">
                    <p class="mb-3">Bukti Transfer : </p>
                    <img class="col-5" src="{{ asset('/storage/public'.'/'.$item->bukti) }}" alt="">
                </div>
                @endforeach
                
                <div class="mt-3">
                    @foreach ($data as $item)
                    <form action="/superadmin/transaksi/approve/{{ $item->users_id }}" method="POST">
                    @endforeach
                        @csrf
                        @method('put')
                        <label for="">Input No Resi: </label>
                        <div class="d-flex">
                            <input type="text" class="form-control w-50" name="resi" required>
                            <input type="hidden" value="{{ $item->users_id }}" name="user">
                            <input type="hidden" value="{{ $item->total }}" name="total">
                            <button type="submit" class="btn btn-primary">Validasi Transaksi</button>
                        </form>
                        @foreach ($data as $item)
                        <form action="/transaksi/decline/{{ $item->users_id }}" method="POST">
                        @endforeach
                            @csrf
                            @method('put')
                            <button type="submit" class=" ms-3 btn btn-danger" onclick="return confirm('Yakin Ingin Menolak Transaksi Ini?')">Tolak Transaksi</button>
                            </form>
                        </div>
                            @if (auth()->user()->role == 'superadmin')
                            <a class="btn btn-warning mt-4" href="/superadmin/transaksi">Kembali</a>
                            @elseif(auth()->user()->role == 'admin')
                            <a class="btn btn-warning mt-4" href="/admin/transaksi">Kembali</a>
                            @endif
                            
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection