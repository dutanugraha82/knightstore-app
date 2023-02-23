<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <h4 class="logo-text">Knight Store</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="/">
                <div class="parent-icon"><i class='bx bx-package'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
           
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
            <ul>
                <li> <a href="/card"><i class="bx bx-right-arrow-alt"></i>Card</a>
                </li>
                <li> <a href="/action-figure"><i class="bx bx-right-arrow-alt"></i>Action Figure</a>
                </li>
                <li> <a href="/others"><i class="bx bx-right-arrow-alt"></i>Others</a>
                </li>
            </ul>
        </li>
        @auth
        @if (auth()->user()->role == 'user')
        <li>
            <a href="/transaksi/{{ auth()->user()->id }}">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Transaksi Saya</div>
            </a>
        </li>
        @endif
        @endauth
    
    <!--end navigation-->
</div>