<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN ANGSURAN</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .kop {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop h1, .kop h2, .kop p {
            margin: 0;
            padding: 0;
        }
        .ttd {
            margin-top: 50px;
            width: 100%;
        }
        .ttd td {
            border: none;
            text-align: center;
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
                    BADAN HUKUM NO. 005044/BH/M.KUKM.2/VIII/2017
                </p>
                <p style="margin: 0; font-size: 16px; font-weight: bold;">
                    JL. LINTAS TIMUR, PASAR BARU, PKL. KERINCI – PELALAWAN
                </p>
            </td>
        </tr>
    </table>
</div>



    {{-- Judul Laporan --}}
    <h2 style="text-align: center;">LAPORAN ANGSURAN</h2>

    {{-- Tabel Data --}}
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>KARYAWAN</th>
                <th>ANGGOTA</th>
                <th>TANGGAL JATUH TEMPO</th>
                <th>JUMLAH ANGSURAN</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan_angsuran as $key => $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pinjaman->user->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->pinjaman->anggota->nama_lengkap ?? '-' }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tgl_jatuh_tempo)) ?? '-' }}</td>
                <td>Rp {{ number_format($item->pinjaman->kategori_angsuran->nominal, 0, ',', '.') }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tanda Tangan --}}
    <table class="ttd">
        <tr>
            <td style="width: 70%;"></td>
            <td>
                Pangkalan Kerinci, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                Mengetahui,<br>
                <br><br><br>
                <u><strong>Taufik Hidayat</strong></u><br>
                MANAGER
            </td>
        </tr>
    </table>

</body>
</html>
