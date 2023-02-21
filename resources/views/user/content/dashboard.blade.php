@extends('user.master.index')
@section('content')
        <div id="carouselExampleControls" class="carousel slide mb-3" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('assets/images/onepiecejpg.jpg') }}" class="d-block w-100" style="height: 10rem; object-fit: fill" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/images/pokemon.jpg') }}" class="d-block w-100" style="height: 10rem" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/images/vanguard.jpg') }}" class="d-block w-100" style="height: 10rem" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/images/yugioh.jpg') }}" class="d-block w-100" style="height: 10rem" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <hr>
          <div class="container-fluid text-center">
            <div class="card p-2">
                <h3 class="my-2">Kategori Produk</h3>
                <hr>
                <div class="container">
                        <div class="row">
                            <div class="col">
                                <a href="/card">
                                    <i class='bx bx-card' style="font-size: 3.5em"></i>
                                    <p>Card</p>
                                 </a>
                            </div>
                            <div class="col">
                                <a href="/action-figure">
                                    <i class='bx bx-walk' style="font-size: 3.5em"></i>
                                    <p>Action Figure</p>
                                 </a>
                            </div>
                            <div class="col">
                                <a href="/others">
                                    <i class='bx bx-dots-horizontal-rounded' style="font-size: 3.5em"></i>
                                    <p>Others</p>
                                 </a>
                            </div>
                        </div>
                </div>
            </div>
          </div>
@endsection