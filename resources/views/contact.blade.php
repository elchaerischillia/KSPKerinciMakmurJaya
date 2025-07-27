@extends('layouts.app')


@section('content')
<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="mb-3">Hubungi Kami</h1>
            <p>Silakan hubungi kami melalui informasi di bawah ini untuk pertanyaan atau kerja sama.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h5>Alamat</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i>Koperasi Simpan Pinjam "Kerinci Makmur Jaya", Pangkalan Kerinci Kota, Kec. Pangkalan Kerinci, Kabupaten Pelalawan, Riau</p>
                <hr>
                <h5>Email</h5>
                <p><i class="fa fa-envelope me-3"></i>KspKerinciMakmurJaya@gmail.com</p>
                <hr>
                <h5>Telepon</h5>
                <p><i class="fa fa-phone-alt me-3"></i>+62 812 3456 7890</p>
            </div>
            <div class="col-lg-8 col-md-6">
                <iframe class="w-100 h-100" style="min-height: 350px; border:0;" 
                    src="https://www.google.com/maps?q=0.3754133238023173, 101.85760026938472&hl=es;z=14&output=embed"
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
