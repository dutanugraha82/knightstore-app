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
                                <input type="text" class="form-control" value="{{ $data->nohp }}" readonly>
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
            <div class="my-3 container">
                @if (auth()->user()->role == 'superadmin')
                <div class="d-flex">
                    @if ($data->role == 'admin')
                    <form action="/superadmin/pengguna/{{ $data->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" class="foto" value="{{ $data->foto }}">
                        <button type="submit" style="width: 100px" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus akun : {{ $data->name }} ?');">Hapus</button>
                    </form>
                    @endif
                    <a href="/superadmin/pengguna/admin" style="width: 100px" class="btn btn-warning d-block ms-auto">Kembali</a>
                </div>
                @elseif(auth()->user()->role == 'admin')
                <a href="/admin" style="width: 150px" class="btn btn-warning d-block ms-auto">Kembali</a>
                @endif
                
            </div>
        </div>
    </div>
@endsection