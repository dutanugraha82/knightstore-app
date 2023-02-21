@extends('admin.master.index')
@section('content')
    <div class="container">
        <div class="card p-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <img class="rounded-circle w-100" src="{{ asset('/storage/public'.'/'.$data->foto) }}" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="card p-3 shadow-lg">
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{ $data->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{ $data->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{ $data->phone }}" readonly>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" value="Tanggal Daftar : {{ $data->created_at }}" readonly>
                            </div>
                            <div>
                                <textarea class="form-control" cols="30" rows="10" readonly>{{ $data->alamat }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-3 mx-3">
                <form action="/superadmin/pengguna/{{ $data->id }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="hidden" class="foto" value="{{ $data->foto }}">
                    <button type="submit" style="width: 100px" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus akun : {{ $data->name }} ?');">Hapus</button>
                </form>
                @if (auth()->user()->role == 'superadmin')
                <a href="/superadmin/" style="width: 100px" class="btn btn-warning d-block ms-auto">Kembali</a>
                @elseif(auth()->user()->role == 'admin')
                <a href="/admin/" style="width: 100px" class="btn btn-warning d-block ms-auto">Kembali</a>
                @endif
                 
            </div>
        </div>
    </div>
@endsection