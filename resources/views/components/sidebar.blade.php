<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">Perpustakaan TUP</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fa-solid fa-book"></i>
            <span>Buku</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Buku</h6>
                <a class="collapse-item" href="{{ route('buku.index') }}">Lihat Semua Buku</a>

                @if ($isAdmin)
                    <a class="collapse-item" href="{{ route('buku.create') }}">Tambah Buku</a>
                @endif
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
            aria-expanded="true" aria-controls="collapseForm">
            <i class="fa-solid fa-book-open"></i>
            <span>Kategori</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kategori</h6>
                <a class="collapse-item" href="{{ route('kategori.index') }}">Lihat Kategori</a>

                @if ($isAdmin)
                    <a class="collapse-item" href="{{ route('kategori.create') }}">Tambah Kategori</a>
                @endif
            </div>
        </div>
    </li>
</ul>
