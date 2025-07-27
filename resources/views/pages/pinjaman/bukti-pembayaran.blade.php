<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .invoice-container {
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #000;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
        }

        .header p {
            font-size: 12px;
            margin: 5px 0;
        }

        .info, .details {
            margin-bottom: 20px;
        }

        .info div, .details div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .info div span, .details div span {
            font-weight: bold;
        }

        .divider {
            height: 1px;
            background-color: #000;
            margin: 20px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {
            font-weight: bold;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature div {
            width: 45%;
            text-align: center;
        }

        .signature div p {
            margin-bottom: 60px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1>INVOICE</h1>
            <p>Nomor Invoice: {{ $pembayaran->kode_trans ?? '-' }}</p>
            <p>Tanggal: {{ date('d-m-Y', strtotime($pembayaran->created_at)) ?? '-' }}</p>
        </div>

        <div class="info">
            <div>
                <span>Teller:</span>
                <span>{{ $pembayaran->user->nama_lengkap ?? '-' }}</span>
            </div>
            <div>
                <span>Nama:</span>
                <span>{{ $angsuran->pinjaman->anggota->nama_lengkap ?? '-' }}</span>
            </div>
            <div>
                <span>Kategori Pinjaman:</span>
                <span>{{ $angsuran->pinjaman->kategori_pinjaman->nama_kategori ?? '-' }}</span>
            </div>
            <div>
                <span>Durasi Angsuran:</span>
                <span>{{ $angsuran->pinjaman->kategori_angsuran->bulan ?? '-' }} Bulan</span>
            </div>
            <div>
                <span>Keterangan:</span>
                <span>{{ $pembayaran->keterangan ?? '-' }}</span>
            </div>
        </div>

        <div class="divider"></div>

        <table class="table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Angsuran per Bulan</td>
                    <td>Rp. {{ number_format($angsuran->pinjaman->kategori_angsuran->nominal, 0, ',', '.') ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Jatuh Tempo</td>
                    <td>{{ date('d-m-Y', strtotime($angsuran->tgl_jatuh_tempo)) ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>{{ $pembayaran->metode_pembayaran ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="divider"></div>

        <div class="total">
            Total: Rp. {{ number_format($pembayaran->nominal, 0, ',', '.') ?? '-' }}
        </div>

        <div class="signature">
            <div>
                <p>Signature</p>
                <p>Manager</p>
            </div>
        </div>


        <div class="footer">
            <p>Terima kasih atas pembayaran Anda!</p>
            <p>Dokumen ini dicetak secara otomatis dan tidak memerlukan tanda tangan.</p>
        </div>
    </div>
</body>
</html>
