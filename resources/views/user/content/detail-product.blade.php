@extends('user.master.index')

@section('content')

@if(session('error'))
<div class="alert alert-outline-white shadow-sm alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
        </div>
        <div class="ms-3">
            <h6 class="mb-0 text-white">Gagal menambahkan barang ke keranjang!</h6>
            <div>{{ session('error') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@foreach($data as $item)
    <div class="card p-3">
    <div class="row g-0">
      <div class="col-md-4 border-end">
        <img src="{{ asset('/storage/public'.'/'.$item->img) }}" class="img-fluid" alt="...">
        
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h4 class="card-title">{{ $item->nama }}</h4>
          <div class="d-flex gap-3 py-3">
          </div>
          <div class="mb-3"> 
            <span class="price h4">@currency($item->harga)</span> 
        </div>
          <p class="card-text fs-6">{{ $item->deskripsi }}</p>
          <dl class="row">
            <dt class="col-sm-3">Rarity</dt>
            <dd class="col-sm-9">{{ $item->rarity }}</dd>
          
            <dt class="col-sm-3">Stok Tersedia</dt>
            <dd class="col-sm-9">{{ $item->qty }}</dd>
          </dl>
          <hr>
          @auth
          @if($item->qty == 0)
           <p>Stock Habis</p>
          @else
           <form action="{{ route('addCart', $item->barang_id) }}" method="POST">
                @csrf
                <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <div class="input-group input-spinner">
                            <button class="btn btn-light" type="button" id="button-minus" onclick="decrementValue()"> − </button>
                            <input type="number" name="qty" class="form-control" id="qty" value="0">
                            <button class="btn btn-light" type="button" id="button-plus" onclick="incrementValue()"> + </button>
                            <input type="hidden" name="gambar" value="{{ encrypt($item->id) }}">
                            <input type="hidden" id="stock" value="{{ $item->qty }}">
                            <input type="hidden" name="sub" value="{{ $item->harga }}">
                        </div>
                    </div> 
                </div>
                <div class="d-flex gap-3 mt-3">
                    <button class="btn btn-light">
                        <span class="text">Add to cart</span>
                        <i class="bx bxs-cart-alt"></i>
                      </button>
                    </form>
                    
                    <form action="{{ route('buyNow', $item->barang_id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-white">Buy Now
                      </button>
                      <input type="hidden" name="qtyNow" id="qtyNow" value="0">
                    </form>
                </div>
            @endif
          @endauth
@endforeach

          @guest
              <a href="/registrasi" class="btn btn-white">Daftar Untuk Membeli Barang Ini!</a>
          @endguest
        </div>
        <a href="/" style="width: 150px;" class="btn btn-light d-block ms-auto">Kembali</a>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script>
    var value = parseInt(document.getElementById('qty').value, 10);
    var stock = parseInt(document.getElementById('stock').value, 10);
  console.log(stock);
    

    function decrementValue(){
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('qty').value = value;
        document.getElementById('qtyNow').value = value;
    }

      function incrementValue(){
        value = isNaN(value) ? 1 : value;
        if (value < stock) {
        value++;
        document.getElementById('qty').value = value;
        document.getElementById('qtyNow').value = value;
        }   
    }

</script>
@endpush