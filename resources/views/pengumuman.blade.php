@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Pengumuman</h2>

    <div class="announcement-list mx-auto" style="max-width: 800px;">
        @forelse ($pengumumen as $item)
            <div class="announcement-item mb-4 p-3 border rounded shadow-sm" style="background-color: #fdfdfd;">
                <h5 class="mb-2">{{ $item->judul }}</h5>
                <div style="font-size: 14px; line-height: 1.6;">
                    {!! nl2br(e($item->isi)) !!}
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada pengumuman.</p>
        @endforelse
    </div>
</div>
@endsection
