<nav class="navbar bg-dark navbar-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/karyawan">Hanif</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('karyawan*') ? 'active' : '' }}" href="/karyawan">Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cuti*') ? 'active' : '' }}" href="/cuti">Cuti</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
