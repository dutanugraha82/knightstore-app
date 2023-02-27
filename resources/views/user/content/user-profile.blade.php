@extends('user.master.index')

@section('content')
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($user->foto)
                            <img src="{{ asset('storage/public'.'/'.$user->foto) }}" class="rounded-circle p-1 bg-primary" width="110">
                            @else
                            <img src="{{ asset('assets/images/avatars/guest.png') }}" alt="{{ Auth::user()->name }}" class="rounded-circle p-1 bg-primary" width="110">
                            @endif
                            <div class="mt-3">
                                <h4>{{ $user->name }}</h4>
                                <p class="mb-1">{{ $user->email }}</p>
                                {{-- <p class="font-size-sm">{{ $user->alamat }}</p> --}}
                            </div>
                        </div>                       
                    </div>
                    <form action="/user-profile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                    <div class="mt-3 p-3">
                        <small class="text-center">Ganti Foto Profile</small>
                        <input type="file" name="foto" class="form-control" id="image" onchange="previewImage()">
                        @if ($user->foto)
                            <input type="hidden" value="{{ $user->foto }}" name="oldImage">
                        @endif
                    </div>
                    <img class="rounded-circle p-1 my-3 img-preview d-block mx-auto" width="200">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama Lengkap</h6>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nomor HP</h6>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="nohp" class="form-control" value="{{ $user->nohp }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="alamat" id="" cols="30" rows="10">{{ $user->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-9 text-end">
                                    <button type="submit" class="btn btn-light px-3">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="container text-center text-md-end">
                    <a href="/" class="btn btn-warning px-3" style="width:150px">Kembali</a>
                </div>
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