<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Simpanan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            font-size: 11px;
        }
        th { background-color: #f4f4f4; }
        .ttd {
            width: 100%;
            margin-top: 30px;
        }
        .ttd td {
            border: none;
            text-align: center;
            vertical-align: top;
        }
    </style>
</head>
<body>

{{-- Kop Surat --}}
@php
    $logoPath = public_path('logo/logo-koperasi.png'); // lokasi file logo
    $logoData = base64_encode(file_get_contents($logoPath));
    $logoSrc = 'data:image/png;base64,' . $logoData;
@endphp

<div style="width: 100%; padding-bottom: 5px; margin-bottom: 10px; border-bottom: 3px solid #000;">
    <table style="width: 100%; border: none;">
        <tr>
            {{-- Logo --}}
            <td style="width: 120px; text-align: center; vertical-align: middle; border: none;">
                <img src="{{ $logoSrc }}" alt="Logo Koperasi" style="width: 110px; height: auto;">
            </td>

            {{-- Teks Kop --}}
            <td style="text-align: center; border: none; vertical-align: middle;">
                <h1 style="margin: 0; font-size: 26px; font-weight: bold;">KSP. KERINCI MAKMUR JAYA</h1>
                <p style="margin: 0; font-size: 16px; font-weight: bold;">
                    JL. LINTAS TIMUR, PASAR BARU, PKL. KERINCI – PELALAWAN
                </p>
                <p style="margin: 0; font-size: 16px;">
                    Telp: 0813-6444-4455 | Email: kspkerincimakmurjaya@gmail.com
                </p>
            </td>
        </tr>
    </table>
</div>

{{-- Judul Laporan --}}
<h2 style="text-align: center; margin: 5px 0;">
    LAPORAN SIMPANAN <br>
    @if($laporan_simpanan->isNotEmpty())
        TAHUN {{ \Carbon\Carbon::parse($laporan_simpanan->first()->created_at)->format('Y') }}
        BULAN {{ \Carbon\Carbon::parse($laporan_simpanan->first()->created_at)->translatedFormat('F') }}
    @endif
</h2>

{{-- Tabel Data --}}
<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>BERGABUNG</th>
            <th>KARYAWAN</th>
            <th>ANGGOTA</th>
            <th>KATEGORI SIMPANAN</th>
            <th>SALDO</th>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($laporan_simpanan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') ?? '-' }}</td>
                <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->anggota->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->kategori_simpan->nama_kategori ?? '-' }}</td>
                <td>Rp. {{ number_format($item->saldo_simpanan, 0, ',', '.') ?? '-' }}</td>
                <td>
                    @if ($item->statu == 1)
                        Active
                    @else
                        Inactive
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Tidak ada data tersedia</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Tanda Tangan --}}
<table class="ttd">
    <tr>
        <td style="width:65%"></td>
        <td style="width:35%;">
            Pangkalan Kerinci, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
            Mengetahui,<br><br><br><br>
            <u><strong>Taufik Hidayat</strong></u><br>
            MANAGER
        </td>
    </tr>
</table>

</body>
</html>
