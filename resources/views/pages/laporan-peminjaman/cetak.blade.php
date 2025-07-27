<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
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
    </style>
</head>
<body>
    <h2 style="text-align: center;">
        LAPORAN PEMINJAMAN <br>
        TAHUN {{ \Carbon\Carbon::parse($laporan_peminjaman->first()->tanggal_pinjam)->format('Y') }} BULAN {{ \Carbon\Carbon::parse($laporan_peminjaman->first()->tanggal_pinjam)->format('m') }}
    </h2>
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
            @forelse ($laporan_peminjaman as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->anggota->nama_lengkap ?? '-' }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_pinjam)) ?? '-' }}</td>
                    <td>{{ $item->kategori_pinjaman->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->kategori_angsuran->bulan ?? '-' }} Bulan x Rp. {{ number_format($item->kategori_angsuran->nominal, 0, ',', '.') }}</td>
                    <td>{{ $item->angunan ?? '-' }}</td>
                    <td>
                        @if ($item->status_pengajuan == 'Pending')
                            Belum Bayar
                        @elseif ($item->status_pengajuan == 'Rejected')
                            Terlambat
                        @elseif ($item->status_pengajuan == 'Approved')
                            Lunas
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
</body>
</html>
