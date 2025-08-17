@extends('layouts.main')

@section('title', 'Angsuran Bermasalah')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">ANGSURAN PINJAMAN BERMASALAH</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="example1">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center" width="15%">NAMA LENGKAP</th>
                        <th class="text-center">TANGGAL PINJAM</th>
                        <th class="text-center">TANGGAL JATUH TEMPO</th>
                        <th class="text-center">NOMINAL</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center" width="20%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($angsuran as $key => $item)
                        <tr>
                            {{-- Nomor urut --}}
                            <td class="text-center">{{ $loop->iteration }}</td>

                            {{-- Nama Anggota --}}
                            <td>{{ $item->pinjaman?->anggota?->nama_lengkap ?? '-' }}</td>

                            {{-- Tanggal Pinjam --}}
                            <td class="text-center">
                                {{ $item->pinjaman?->tanggal_pinjam ? date('d-m-Y', strtotime($item->pinjaman->tanggal_pinjam)) : '-' }}
                            </td>

                            {{-- Jatuh Tempo --}}
                            <td class="text-center">
                                {{ $item->tgl_jatuh_tempo ? date('d-m-Y', strtotime($item->tgl_jatuh_tempo)) : '-' }}
                            </td>

                            {{-- Nominal --}}
                            <td class="text-center">
                                Rp. {{ number_format($item->pinjaman?->kategori_angsuran?->nominal ?? 0, 0, ',', '.') }}
                            </td>

                            {{-- Status --}}
                            <td class="text-center">
                                @if ($item->status == 'Belum Bayar')
                                    <span class="label label-warning">Belum Bayar</span>
                                @elseif ($item->status == 'Terlambat')
                                    <span class="label label-danger">Terlambat</span>
                                @elseif ($item->status == 'Lunas')
                                    <span class="label label-success">Lunas</span>
                                @else
                                    <span class="label label-default">Bermasalah</span>
                                @endif
                            </td>
{{-- Aksi --}}
<td class="text-center">
    {{-- Kirim WA --}}
    <form action="{{ route('angsuran.notify', $item->id) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-success btn-sm"
            onclick="return confirm('Kirim pesan WA ke {{ $item->pinjaman?->anggota?->nama_lengkap ?? 'Anggota' }}?')">
            <i class="fas fa-paper-plane"></i> Kirim WA
        </button>
    </form>

    {{-- Detail --}}
    <a href="{{ route('angsuran-bermasalah.show', $item->id) }}" class="btn btn-info btn-sm ml-1">
        <i class="fa fa-eye"></i> Detail
    </a>
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data angsuran bermasalah</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section>
@endsection
