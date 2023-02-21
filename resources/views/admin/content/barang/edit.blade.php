@extends('admin.master.index')
@section('content')
    <div class="container">
        <h3>
            Sunting Data Barang
        </h3>
        <div class="card p-2">
            @if (auth()->user()->role == 'superadmin')
            <form action="/superadmin/barang/{{ $barang->id }}" method="POST" enctype="multipart/form-data">
            @elseif(auth()->user()->role == 'admin')
            <form action="/admin/barang/{{ $barang->id }}" method="POST" enctype="multipart/form-data">
            @endif
                @csrf
                @method('put')
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-2" for="nama">Nama Barang</label>
                                <input type="text" name="nama" class="form-control" required value="{{ $barang->nama }}">
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="rarity">Rarity Barang</label>
                                <input type="text" name="rarity" class="form-control" required value="{{ $barang->rarity }}">
                            </div>
                            <div class="mb-3">
                                <label for="qty">Kuantitas Barang</label>
                                <input type="number" name="qty" class="form-control" required value="{{ $barang->qty }}">
                            </div>
                            @if (count($gambar) < 3)
                            <div class="mb-3">
                                <label for="gambar">Tambah Gambar</label>
                                <input type="file" name="img" class="form-control" onchange="previewImage()" id="image">
                            </div>
                            <div class="mb-3">
                                <img class="img-preview col-5 rounded"  alt="">
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kode" class="mb-2">Kode Barang</label>
                                <input type="text" name="kode" class="form-control" required value="{{ $barang->kode }}">
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="kategori" id="">
                                    <option value="{{ $barang->kategori }}">{{ $barang->kategori }}</option>
                                    <option value="Action Figure">Action Figure</option>
                                    <option value="Card">Card</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="mb-2">Harga Barang</label>
                                <input type="number" name="harga" class="form-control" required value="{{ $barang->harga }}">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" cols="30" rows="10" required>{{ $barang->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="my-4">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary">Sunting Data</button>
                        @if (auth()->user()->role == 'superadmin')
                            <a href="/superadmin/barang" class="btn btn-warning ms-3">Kembali</a>
                        @elseif(auth()->user()->role == 'admin')
                            <a href="/admin/barang" class="btn btn-warning ms-3">Kembali</a>
                        @endif
                    </div>
                </div>
            </form>
            <hr>
            <div class="container">
                <div class="row">
                    <h4 class="text-center mb-3">Data Gambar</h4>
                    @if ($gambar)
                    @foreach ($gambar as $item)
                        <div class="col-md-4 ms-md-3 card p-2">
                            <img class="rounded  mb-3" src="{{ asset('/storage/public'.'/'.$item->img) }}" alt="">
                            <div class="d-flex">
                                @if (auth()->user()->role == 'superadmin')
                                    <a href="/superadmin/barang/{{ $item->id }}/img" class="btn btn-warning">Ganti Gambar</a>
                                @elseif(auth()->user()->role == 'admin')
                                    <a href="/admin/barang/{{ $item->id }}/img" class="btn btn-warning">Ganti Gambar</a>
                                @endif

                                @if (auth()->user()->role == 'superadmin')
                                    <form action="/superadmin/barang/{{ $item->id }}/img" method="POST">
                                @elseif(auth()->user()->role == 'admin')
                                    <form action="/admin/barang/{{ $item->id }}/img" method="POST">
                                @endif

                                    @csrf
                                    @method('delete')
                                <input type="hidden" name="img" value="{{ $item->img }}">
                                <input type="hidden" name="barang" value="{{ $item->barang_id }}">
                                <button type="submit" class="btn btn-danger ms-4" onclick="return confirm('Anda yakin ingin menghapus gambar?');">Hapus Gambar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                        
                    @else
                        <p class="text-center">Gambar Kosong</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function previewImage()
        {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush