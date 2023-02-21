@extends('admin.master.index')
@section('content')
    <div class="container">
        <div class="card">
            @if (auth()->user()->role == 'superadmin')
                <form action="/superadmin/barang/{{ $gambar->id }}/img-update" method="post" enctype="multipart/form-data">
            @elseif(auth()->user()->role == 'admin')
                <form action="/admin/barang/{{ $gambar->id }}/img-update" method="post" enctype="multipart/form-data">
            @endif
                @csrf
                @method('put')
                <div class="container">
                    <div class="card p-2">
                        <h3 class="card-title mb-4">Ganti Gambar</h3>   
                        <div class="row">
                            <div class="col-md-6">
                                <p><i>Gambar Sekarang : </i></p>
                                <img class="col-5 rounded" src="{{ asset('/storage/public'.'/'.$gambar->img) }}" alt="">
                                <input type="hidden" value="{{ $gambar->img }}"  name="oldImage">
                            </div>
                            <div class="col-md-6">
                                <label for="image">Gambar Baru</label>
                                <input type="file" class="form-control mb-3" name="img" id="image" onchange="previewImage()">
                                <p><i>Gambar Baru : </i></p>
                                <img class="img-preview col-5 rounded"  alt="">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <button type="submit" class="btn btn-primary">Ubah Gambar!</button>
                        @if (auth()->user()->role == 'superadmin')
                            <a href="/superadmin/barang/{{ $gambar->barang_id }}/edit" class="btn btn-warning ms-3">Kembali</a>
                        @elseif(auth()->user()->role == 'admin')
                            <a href="/admin/barang/{{ $gambar->barang_id }}/edit" class="btn btn-warning ms-3">Kembali</a>   
                        @endif
                       
                    </div>
                </div>

            </form>
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