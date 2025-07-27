@extends('layouts.app') {{-- Ganti 'app' dengan layout yang kamu gunakan --}}

@section('title', 'Struktur Organisasi')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Struktur Organisasi</h2>
    
    <div class="row justify-content-center">
        @foreach($strukturs as $struktur)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card text-center h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $struktur->foto) }}" alt="{{ $struktur->nama }}" class="card-img-top img-fluid" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $struktur->nama }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($strukturs->isEmpty())
        <p class="text-center text-muted">Belum ada data struktur organisasi.</p>
    @endif
</div>
@endsection
