<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand">
        <a class="navbar-brand fs-5 fw-bold" href="/">
            <span class="merek">Welding</span> ragon
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="fa-duotone fa-grid-2 me-3"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/berita') ? 'active' : '' }}">
            <a href="{{ route('berita.index') }}" class="menu-link">
                <i class="fa-duotone fa-newspaper me-3"></i>
                <div data-i18n="Analytics">Berita</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/kategori-berita') ? 'active' : '' }}">
            <a href="{{ route('kategori-berita.index') }}" class="menu-link">
                <i class="fa-duotone fa-grip-dots-vertical me-4"></i>
                <div data-i18n="Analytics">Kategori Berita</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/welder') ? 'active' : '' }}">
            <a href="{{ route('welder.index') }}" class="menu-link">
                <i class="fa-regular fa-screwdriver-wrench me-3"></i>
                <div data-i18n="Analytics">Welder</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/user') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="fa-duotone fa-user me-3"></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>

    </ul>

</aside>
