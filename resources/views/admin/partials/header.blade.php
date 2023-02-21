<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="header-notifications-list">
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="header-message-list">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/public'.'/'.auth()->user()->foto) }} " class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                        <p class="designattion mb-0"><small>login sebagai : </small>{{ auth()->user()->role }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    {{-- Superadmin --}}
                    @if (auth()->user()->role == 'superadmin')
                    <li><a class="dropdown-item" href="/superadmin/pengguna/{{ auth()->user()->id }}/akun"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>

                    <li><a class="dropdown-item" href="/superadmin/pengguna/{{ auth()->user()->id }}/edit"><i class="bx bx-cog"></i><span>Edit Profile</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger dropdown-item"><i class="bx bx-log-out-circle"></i>Log out</button>
                        </form>
                    </li>
                    {{-- Admin --}}
                    @elseif(auth()->user()->role == 'admin')
                    <li><a class="dropdown-item" href="/admin/pengguna/{{ auth()->user()->id }}/akun"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>

                    <li><a class="dropdown-item" href="/admin/pengguna/{{ auth()->user()->id }}/edit"><i class="bx bx-cog"></i><span>Edit Profile</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger dropdown-item"><i class="bx bx-log-out-circle"></i>Log out</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>