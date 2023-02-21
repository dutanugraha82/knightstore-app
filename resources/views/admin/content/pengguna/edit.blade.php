@extends('admin.master.index')
@section('content')
    <div class="container">
        <div class="card p-3">
            <h4 class="text-center mb-4">Edit Profile</h4>
            @if (auth()->user()->role == 'superadmin')
            <form action="/superadmin/pengguna/{{ $data->id }}" method="POST" enctype="multipart/form-data">
            @elseif(auth()->user()->role == 'admin')
            <form action="/admin/pengguna/{{ $data->id }}" method="POST" enctype="multipart/form-data">
            @endif
            @csrf
            @method('put')            
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <img class="rounded-circle w-100 mb-3" src="{{ asset('/storage/public'.'/'.$data->foto) }}" alt="">
                        <div class="my-3">
                            <input type="file" class="form-control" name="foto" id="image" onchange="previewImage()">
                            <input type="hidden" name="oldImage" value="{{ $data->foto }}" >
                            <label for="">Ganti Foto Profile</label>

                        </div>
                        <div class="mb-3">
                            <img class="img-preview rounded-circle w-100"alt="">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card p-3 shadow-lg">
                            <div class="mb-3">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $data->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="">No Handphone</label>
                                <input type="text" name="nohp" class="form-control" value="{{ $data->nohp }}" required>
                            </div>
                            <div>
                                <label for="">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" cols="30" rows="10" required>{{ $data->alamat }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 container d-flex">
                @if (auth()->user()->role == 'superadmin')
                <a href="/superadmin/pengguna/admin" style="width: 150px" class="btn btn-warning">Kembali</a>
                @elseif(auth()->user()->role == 'admin')
                <a href="/admin" style="width: 150px" class="btn btn-warning">Kembali</a>
                @endif
                <button type="submit" class="btn btn-success d-block ms-auto">Submit Data</button>
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