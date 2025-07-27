<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand">
            <h1 class="text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>KSP Kerinci Makmur Jaya </h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="/pengumumanhome" class="nav-item nav-link">Pengumuman</a>
                <a href="/galerihome" class="nav-item nav-link">Galeri</a>
                <a href="/faqhome" class="nav-item nav-link">FAQ</a>
                <a href="/contacthome" class="nav-item nav-link">Kontak</a>


            </div>
           <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4 d-none d-lg-block">Login</a>

        </div>
    </nav>
</div>
