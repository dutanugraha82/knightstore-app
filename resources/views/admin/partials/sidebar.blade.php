@if (auth()->user()->role == 'superadmin')
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }} " class="logo-icon" alt="logo icon">
        </div>
            <h4 class="logo-text">Knight Card Admin</h4>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="/superadmin">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="/superadmin/barang">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Master Barang</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="/superadmin/transaksi"><i class="bx bx-right-arrow-alt"></i>Transaksi Masuk</a>
                </li>
                <li> <a href="/superadmin/transaksi-berlangsung"><i class="bx bx-right-arrow-alt"></i>Transaksi Berlangsung</a>
                </li>
                <li> <a href="/superadmin/transaksi-selesai"><i class="bx bx-right-arrow-alt"></i>Tansaksi Selesai</a>
                </li>
                </li>
            </ul>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Pengguna</div>
            </a>
            <ul>
                <li> <a href="/superadmin/pengguna/admin"><i class="bx bx-right-arrow-alt"></i>Admin</a>
                </li>
                <li> <a href="/superadmin/pengguna/user"><i class="bx bx-right-arrow-alt"></i>Customer</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
@elseif (auth()->user()->role == 'admin')
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
            <h5>Knight Card Admin</h5>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="/admin">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="/admin/barang">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Master Barang</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="/admin/transaksi"><i class="bx bx-right-arrow-alt"></i>Transaksi Masuk</a>
                </li>
                <li> <a href="/admin/transaksi-berlangsung"><i class="bx bx-right-arrow-alt"></i>Transaksi Berlangsung</a>
                </li>
                <li> <a href="/admin/transaksi-selesai"><i class="bx bx-right-arrow-alt"></i>Tansaksi Selesai</a>
                </li>
                </li>
            </ul>
        
    </ul>
    <!--end navigation-->
</div>
@endif
