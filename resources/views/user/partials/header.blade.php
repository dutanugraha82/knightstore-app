@push('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Phudu&family=Raleway:wght@200;300&display=swap');
    </style>
@endpush
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="col">
                <div class="text-center ms-3 ms-md-0"> 
                        <h5 style="font-family: 'Raleway', sans-serif; font-size:1em;"><strong>KNIGHT CARD GAME</strong></h5>
                    </a>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">                    
                    @if(Auth::check() && Auth::user()->role == 'user')
                    <div class="col">
                        <div class="icon-badge position-relative bg-light me-lg-3"> 
                            <a href="{{ url('cart') }}">
                                <i class="bx bxs-cart align-middle font-22 text-white"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ \App\Models\Cart::where('user_id',auth()->user()->id)->count()}}</span>
                            </a>
                        </div>
                    </div>
                    @endif
                   
                    <li class="nav-item dropdown dropdown-large d-none">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">7</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            
                            <div class="header-notifications-list">
                                
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large d-none">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                            <i class='bx bx-comment'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           
                            <div class="header-message-list">
                                
                            </div>
                            
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (auth()->check())
                    <div class="user-info d-flex">
                        @if (auth()->user()->foto)
                        <img src="{{ asset('storage/public'.'/'. auth()->user()->foto) }} " class="user-img" alt="user avatar">
                        @else
                        <img src="{{ asset('assets/images/avatars/guest.png') }} " class="user-img" alt="user avatar">
                        @endif
                        <p class="user-name ps-2 mb-0 d-none d-md-block">{{ auth()->user()->name }}</p>
                    </div>  
                    @else
                    <div class="user-info d-flex">
                    <img src="{{ asset('assets/images/avatars/guest.png') }} " class="user-img" alt="user avatar">
                        <p class="user-name ps-2 mb-0 d-none d-md-block">Guest</p>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @if (auth()->check())
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>  
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger dropdown-item">
                                <i class="bx bx-log-out-circle bx-xs"></i>Log out
                            </button>
                        </form>
                    </li>
                    @else
                    <li>
                        <a class="dropdown-item" href="{{ route('login') }}"><i class="bx bx-user"></i><span>Login</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('register') }}"><i class="bx bx-user-plus"></i><span>Register</span></a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>