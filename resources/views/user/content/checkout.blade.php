@extends('user.master.index')

@section('breadcrumbs')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">eCommerce</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<form action="/checkout" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row justify-content-center">
    <div class="col-lg-6 mb-4 border p-4 rounded">
      <h3>Rincian Harga</h3>
      <hr>
      <div class="alamat">
        @foreach ($data as $item)
        <div class="mb-3 d-flex justify-content-between">
          <h6>{{ $item->gambarBarang->barang->nama }}</h6>
          <p>Rp {{ $item->gambarBarang->barang->harga }}</p>
          <input name="barang[]" type="hidden" value="{{ $item->barang_id }}">
        </div>
        <div class="mb-3">
          <label for="">Total Item</label>
          <input type="number" class="form-control w-25" name="qty[]" value="{{ $item->qty }}" readonly>
        </div>
        <hr class="mb-3">
        @endforeach
        <div class="d-flex justify-content-between">
          <p>Ongkos Kirim: </p>
          <p>Rp 12000</p>
        </div>
        <hr>
        <h4>Total : Rp {{ $total }}</h4>
      </div>
    </div>  
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-6 mb-4 border p-4 rounded">
      <h3>Metode Pembayaran</h3>
      <hr>
      <div class="alamat">
        <div class="fs-6 mb-4">
          <h5>BCA</h5>
        </div>
        <h6>Jhon Doe</h6>
        <p>xxxx-xxxx-xxxx-xxxx</p>
      </div>
      <div class="text-center">
        <small>*Bukti Transafer*</small>
        <input type="file" name="bukti" id="image" class="form-control mb-3" onchange="previewImage()">
        <img class="img-preview col-5 d-block mx-auto" alt="">
      </div>
    </div>  
  </div>
  <div class="row justify-content-center my-4">
    <button type="submit" class="btn btn-light px-5 col-lg-6 radius-30">Bayar</button>
    {{-- <a href="{{ url('/invoice') }}" class="btn btn-light px-5 col-lg-6 radius-30">Bayar</a> --}}
  </div>
</form>
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