@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Galeri Kegiatan</h2>
    <div class="row">
        @forelse ($galeris as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="{{ $item->judul }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p>{{ $item->deskripsi }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Tidak ada galeri.</p>
        @endforelse
    </div>
</div>
@endsection
