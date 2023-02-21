@extends('admin.master.index')
@section('content')
    <div class="container">
        <h3>
            Tambah Data Barang
        </h3>
        <div class="card p-2">
            @if (auth()->user()->role == 'superadmin')
            <form action="/superadmin/barang" method="POST" enctype="multipart/form-data">     
            @elseif(auth()->user()->role == 'admin')
            <form action="/admin/barang" method="POST" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="mb-2" for="nama">Nama Barang</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="rarity">Rarity Barang</label>
                                <input type="text" name="rarity" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="qty">Kuantitas Barang</label>
                                <input type="number" name="qty" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="gambar">Gambar Barang 1</label>
                                <input type="file" name="image[]" class="form-control" id="image1" onchange="previewImage1()" required>
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="gambar">Gambar Barang 2</label>
                                <input type="file" name="image[]" class="form-control" id="image2" onchange="previewImage2()">
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="gambar">Gambar Barang 3</label>
                                <input type="file" name="image[]" class="form-control" id="image3" onchange="previewImage3()">
                            </div>
                            <div class="mb-3">
                                <label for="deskripi">Deskripsi Barang</label>
                                <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kode" class="mb-2">Kode Barang</label>
                                <input type="text" name="kode" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="kategori" id="">
                                    <option value="">Pilih Kategori Barang</option>
                                    <option value="Action Figure">Action Figure</option>
                                    <option value="Card">Card</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="mb-2">Harga Barang</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <p>Preview Gambar 1</p>
                                <img class="img-preview1 mb-3 col-sm-5 border-radius-lg">
                            </div>
                            <div class="mb-3">
                                <p>Preview Gambar 2</p>
                                <img class="img-preview2 mb-3 col-sm-5 border-radius-lg">
                            </div>
                            <div class="mb-3">
                                <p>Preview Gambar 3</p>
                                <img class="img-preview3 mb-3 col-sm-5 border-radius-lg">
                            </div>
                            <input type="hidden" name="barang_id">
                        </div>
                    </div>
                </div>
                <div class="my-4">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                        @if (auth()->user()->role == 'superadmin')
                            <a href="/superadmin/barang" class="btn btn-warning ms-3">Kembali</a>
                        @elseif(auth()->user()->role == 'admin')
                            <a href="/admin/barang" class="btn btn-warning ms-3">Kembali</a>
                        @endif
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function previewImage1()
        {
            const image = document.querySelector('#image1');
            const imagePreview = document.querySelector('.img-preview1');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imagePreview.src = oFREvent.target.result;
            }
        }
        function previewImage2()
        {
            const image = document.querySelector('#image2');
            const imagePreview = document.querySelector('.img-preview2');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imagePreview.src = oFREvent.target.result;
            }
        }

        function previewImage3()
        {
            const image = document.querySelector('#image3');
            const imagePreview = document.querySelector('.img-preview3');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush