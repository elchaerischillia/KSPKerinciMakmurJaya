@extends('layouts.app')

@section('content')

<!-- Hero Start -->
<div class="jumbotron jumbotron-fluid position-relative overlay-bottom mb-5" 
     style="background: url('{{ asset('assets/frontsite/img/header.jpg') }}') center center no-repeat; background-size: cover;">
    <div class="container text-center text-white py-5">
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Poppins', sans-serif; letter-spacing: 1px;">
            Koperasi Simpan Pinjam
        </h1>
        <p class="lead fs-6" style="max-width: 700px; margin: auto;">
            Membangun masa depan finansial bersama melalui simpanan dan pinjaman yang aman dan terpercaya.
        </p>
        <a href="#pengumuman" class="btn btn-primary btn-lg mt-4 shadow rounded-pill px-4">Lihat Pengumuman</a>
    </div>
</div>
<!-- Hero End -->

<!-- Pengumuman Start -->
<div id="pengumuman" class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary text-uppercase fw-bold">Pengumuman</h6>
            <h2 class="fw-bold">Informasi Terbaru</h2>
        </div>

        <div class="accordion shadow-sm" id="pengumumanAccordion">
            @forelse ($pengumumen as $item)
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingPengumuman{{ $loop->index }}">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsePengumuman{{ $loop->index }}">
                            <i class="fa fa-bullhorn text-primary me-2"></i>{{ $item->judul }}
                        </button>
                    </h2>
                    <div id="collapsePengumuman{{ $loop->index }}" 
                         class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                         data-bs-parent="#pengumumanAccordion">
                        <div class="accordion-body">
                            {!! nl2br(e($item->isi)) !!}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada pengumuman.</p>
            @endforelse
        </div>
    </div>
</div>
<!-- Pengumuman End -->

<!-- Galeri Start -->
<div id="galeri" class="container-fluid py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary text-uppercase fw-bold">Galeri</h6>
            <h2 class="fw-bold">Galeri Koperasi</h2>
        </div>
        <div class="row g-4">
            @forelse ($galeris as $item)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="{{ asset('storage/' . $item->foto) }}" 
                             class="card-img-top" 
                             alt="{{ $item->judul }}" 
                             style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                            <p class="card-text text-muted">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada data galeri.</p>
            @endforelse
        </div>
    </div>
</div>
<!-- Galeri End -->

<!-- FAQ Start -->
<div id="faq" class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary text-uppercase fw-bold">Frequently Asked Questions</h6>
            <h2 class="fw-bold">Pertanyaan yang Sering Diajukan</h2>
        </div>
        <div class="accordion shadow-sm" id="faqAccordion">
            @forelse ($faqs as $faq)
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingFaq{{ $loop->index }}">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseFaq{{ $loop->index }}">
                            <i class="fa fa-question-circle text-primary me-2"></i>{{ $faq->pertanyaan }}
                        </button>
                    </h2>
                    <div id="collapseFaq{{ $loop->index }}" 
                         class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! nl2br(e($faq->jawaban)) !!}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada pertanyaan tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
<!-- FAQ End -->

<!-- Struktur Organisasi Start -->
<div id="struktur" class="container-fluid py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary text-uppercase fw-bold">Struktur</h6>
            <h2 class="fw-bold">Struktur Organisasi</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($strukturs as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <img src="{{ asset('storage/' . $item->foto) }}" 
                             class="card-img-top img-fluid rounded-top" 
                             alt="{{ $item->nama }}" 
                             style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-0">{{ $item->nama }}</h5>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada data struktur organisasi.</p>
            @endforelse
        </div>
    </div>
</div>
<!-- Struktur Organisasi End -->

<!-- Footer Start -->
<div id="contact" class="container-fluid bg-dark text-white-50 py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <h5 class="text-white fw-bold">Hubungi Kami</h5>
                <p><i class="fa fa-map-marker-alt me-2"></i>Koperasi Simpan Pinjam Ksp. Kerinci Makmur Jaya, Pangkalan Kerinci Kota, Kec. Pangkalan Kerinci, Kabupaten Pelalawan, Riau</p>
                <p><i class="fa fa-phone-alt me-2"></i>0895 0817 7035</p>
                <p><i class="fa fa-envelope me-2"></i>kspkerincimakmurjaya@gmail.com</p>
            </div>
            <div class="col-md-6 mb-4">
                <h5 class="text-white fw-bold">Ikuti Kami</h5>
                <a class="btn btn-outline-light btn-social me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social me-2" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-social me-2" href="#"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="text-center mt-3">
            <small>&copy; 2025 Ksp Kerinci Makmur Jaya X Pdsku Manajemen Informatika.</small>
        </div>
    </div>
</div>
<!-- Footer End -->

@endsection
