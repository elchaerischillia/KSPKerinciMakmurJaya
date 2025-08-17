<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .kop {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .kop h1 { margin: 0; font-size: 18px; }
        .kop p { margin: 0; font-size: 12px; }
        h2 { text-align: center; margin: 5px 0; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            font-size: 11px;
        }
        th {
            background-color: #f4f4f4;
        }
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
    <h2>
        LAPORAN PEMINJAMAN <br>
        @if($laporan_peminjaman->isNotEmpty())
            TAHUN {{ \Carbon\Carbon::parse($laporan_peminjaman->first()->tanggal_pinjam)->format('Y') }}
            BULAN {{ \Carbon\Carbon::parse($laporan_peminjaman->first()->tanggal_pinjam)->translatedFormat('F') }}
        @endif
    </h2>

    {{-- Tabel Data --}}
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>KARYAWAN</th>
                <th>ANGGOTA</th>
                <th>TANGGAL PINJAM</th>
                <th>KATEGORI PEMINJAMAN</th>
                <th>ANGSURAN</th>
                <th>ANGUNAN</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan_peminjaman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->anggota->nama_lengkap ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ $item->kategori_pinjaman->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->kategori_angsuran->bulan ?? '-' }} Bulan x Rp. {{ number_format($item->kategori_angsuran->nominal, 0, ',', '.') }}</td>
                    <td>{{ $item->angunan ?? '-' }}</td>
                    <td>
                        @if ($item->status_pengajuan == 'Pending')
                            Pending
                        @elseif ($item->status_pengajuan == 'Rejected')
                            Tidak Disetujui
                        @elseif ($item->status_pengajuan == 'Approved')
                            Disetujui
                        @else
                            Tidak Diketahui
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data tersedia</td>
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
