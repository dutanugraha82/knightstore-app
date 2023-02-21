@extends('admin.master.index')
@section('content')
    <div class="container">
    <h4 class="text-center">Registrasi Data Admin Baru</h4>
    <div class="card p-2">
        <div class="container p-2">
            <form action="{{ route('superadmin.pengguna.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="mb-2" for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Isi nama lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="nohp">Nomor Handphone</label>
                        <input type="text" name="nohp" class="form-control" placeholder="Nomor Hp aktif/prioritas" required>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="email">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email aktif" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputChoosePassword" class="form-label">Password</label>
                        <div class="input-group" id="show_hide_password">
                        <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Masukan Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Role</label>
                        <select name="role" class="form-control">
                            <option value="">----Pilih Role----</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="mb-2" for="foto">Foto Profile</label>
                        <input type="file" name="foto" class="form-control" id="image" onchange="previewImage()" required>
                    </div>
                    <div class="mb-3">
                        <img class="img-preview col-5" alt="">
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="10">
                        </textarea>
                    </div>

                </div>
            </div>
            <div class="my-4 d-flex">
                <button type="submit" class="btn btn-primary">Submit Data</button>
                <a href="/superadmin/pengguna/admin" class="d-block ms-auto btn btn-warning">Kembali</a>
            </div>
            </form>
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

        $(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
    </script>
@endpush