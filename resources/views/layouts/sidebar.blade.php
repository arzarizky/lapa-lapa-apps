<div class="main-sidebar" id="sidebar">
    <aside id="sidebar-wrapper">

        <div class="sidebar-brand" style="padding-bottom: 30px;">
            <img class="logo" src="{{ asset('template') }}/assets/img/logo-lalapa.svg" alt="logo">
            <span>
                <hr>
                <p>Manage Your Apps</p>
                <hr>
            </span>

        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">L A</a>
            <hr style="width: 41px; margin-top: 0px;">
        </div>

        <ul class="sidebar-menu">

            @role('Super Admin')
                <li class="{{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('superadmin.dashboard.index') }}">
                        <i class="fas fa-fire"></i></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->segment(2) == 'data-komuditas' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('superadmin.data-komoditas.index') }}">
                        <i class="fas fa-pepper-hot"></i>
                        <span>Data Komoditas</span>
                    </a>
                </li>

                <li class="{{ request()->segment(2) == 'data-inflasi' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('superadmin.inflasi.index') }}">
                        <i class="fas fa-percentage"></i>
                        <span>Data Inflasi</span>
                    </a>
                </li>

                <li class="{{ request()->segment(2) == 'data-pertumbuhan-ekonomi' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('superadmin.pertumbuhan-ekonomi.index') }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Data Pertumbuhan Ekonomi</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) == 'manajemen-user' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('superadmin.manajemen-user.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Manage User</span>
                    </a>
                </li>
            @endrole

            @role('Admin')
                <li class="{{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                        <i class="fas fa-fire"></i></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->segment(2) == 'data-komuditas' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.data-komoditas.index') }}">
                        <i class="fas fa-pepper-hot"></i>
                        <span>Data Komoditas</span>
                    </a>
                </li>
            @endrole

            {{-- <li class="">
                <a class="nav-link" href="/manajemen-data">
                    <i class="fas fa-folder-open"></i>
                    <span>Manajemen Data</span>
                </a>
            </li> --}}

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="/" target="blank" class="btn btn-warning btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Buka Website
            </a>
        </div>

    </aside>
</div>
