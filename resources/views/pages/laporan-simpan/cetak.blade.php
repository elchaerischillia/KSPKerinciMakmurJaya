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
    <h2 style="text-align: center;">LAPORAN SIMPANAN</h2>
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
            @forelse ($laporan_simpanan as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->created_at)) ?? '-' }}</td>
                    <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->anggota->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->kategori_simpan->nama_kategori ?? '-' }}</td>
                    <td>
                        Rp. {{ number_format($item->saldo_simpanan, 0, ',', '.') ?? '-' }}
                    </td>
                    <td>
                        @if ($item->statu == 1)
                            <span class="label label-success">Active</span>
                        @else
                            <span class="label label-danger">Inactive</span>
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
