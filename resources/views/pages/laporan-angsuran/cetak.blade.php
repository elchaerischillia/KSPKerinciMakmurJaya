<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN SIMPANAN</title>
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
    <h2 style="text-align: center;">LAPORAN ANGSURAN</h2>
    <table>
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th>KARYAWAN</th>
                <th class="text-center">ANGGOTA</th>
                <th class="text-center">TANGGAL JATUH TEMPO</th>
                <th class="text-center">JUMLAH ANGSURAN</th>
                <th class="text-center">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan_angsuran as $key => $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->pinjaman->user->nama_lengkap ?? '-' }}</td>
                <td class="text-center">{{ $item->pinjaman->anggota->nama_lengkap ?? '-' }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($item->tgl_jatuh_tempo)) ?? '-' }}</td>
                <td>{{ number_format($item->pinjaman->kategori_angsuran->nominal, 0, ',', '.') }}</td>
                <td class="text-center">
                    {{ $item->status }}
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
