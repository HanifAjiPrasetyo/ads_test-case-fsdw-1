<nav class="navbar bg-dark navbar-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/api/karyawan">Hi, {{ auth()->user()->name }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('api/karyawan') ? 'active' : '' }}" href="/api/karyawan">Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('api/cuti*') ? 'active' : '' }}" href="/api/cuti">Cuti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('api/karyawan/first-three-karyawan') ? 'active' : '' }}" href="/api/karyawan/first-three-karyawan">3 Karyawan Pertama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('api/karyawan/pernah-cuti') ? 'active' : '' }}" href="/api/karyawan/pernah-cuti">Karyawan Pernah Cuti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('api/karyawan/sisa-cuti') ? 'active' : '' }}" href="/api/karyawan/sisa-cuti">Sisa Cuti Karyawan</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm" href="/api/logout" onclick="return confirm('Logout?')">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
