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
        @forelse ($transaksi_simpan as $item)

        @empty

        @endforelse
        <div class="header">
            <h1>INVOICE</h1>
            <p>Nomor Invoice: {{ $transaksi_simpan->kode_transaksi ?? '-' }}</p>
        </div>

        <div class="info">
            <div>
                <span>TELLER:</span>
                <span>{{ $transaksi_simpan->user->nama_lengkap ?? '-' }}</span>
            </div>
            <div>
                <span>NASABAH:</span>
                <span>{{ $simpan->anggota->nama_lengkap ?? '-' }}</span>
            </div>
            <div>
                <span>KATEGORI SIMPAN:</span>
                <span>{{ $simpan->kategori_simpan->nama_kategori ?? '-' }}</span>
            </div>
            <div>
                <span>JENIS TRANSAKSI:</span>
                <span>{{ $transaksi_simpan->jenis_transaksi ?? '-' }}</span>
            </div>
            <div>
                <span>KETERANGAN:</span>
                <span>{{ $pembayaran->keterangan ?? '-' }}</span>
            </div>
        </div>

        <div class="divider"></div>

        <table class="table">
            <thead>
                <tr>
                    <th>DESKRIPSI</th>
                    <th>JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>JUMLAH : </td>
                    <td>Rp. {{ number_format($transaksi_simpan->nominal, 0, ',', '.') ?? '-' }}</td>
                </tr>
                <tr>
                    <td>TANGGAL TRANSAKSI :</td>
                    <td>{{ date('d-m-Y H:i', strtotime($transaksi_simpan->created_at)) ?? '-' }}</td>
                </tr>
                <tr>
                    <td>METODE PEMBAYARAN :</td>
                    <td>{{ $transaksi_simpan->metode_pembayaran ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="divider"></div>

        <div class="total">
            SALDO: Rp. {{ number_format($transaksi_simpan->saldo_akhir, 0, ',', '.') ?? '-' }}
        </div>

        <div class="signature">
            <div>
                <p>Signature</p>
                <p>Manager</p>
            </div>
        </div>


        <div class="footer">
            <p>Terima kasih atas pembayaran Anda!</p>
            <p>Dokumen ini dicetak secara otomatis </p>
        </div>
    </div>
</body>
</html>
