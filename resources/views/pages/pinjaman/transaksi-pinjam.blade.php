@extends('layouts.main')

@section('title', 'Transaksi Pinjaman')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>TRANSAKSI PINJAMAN</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('simpan.index') }}">DATA DAFTAR ANGGOTA PINJAMAN</a></li>
            <li class="active">TRANSAKSI PINJAMAN</li>
        </ol>
    </section>
    <!-- /.breadcrumb -->

    <section class="content">
        <!-- alert success -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ session('success') }}
            </div>
        @endif
        <!-- /.alert success -->

        <!-- alert error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Error!</h4>
                {{ session('error') }}
            </div>
        @endif
        <!-- /.alert error -->

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">DETAIL PEMINJAMAN</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('pinjaman.index') }}" class="btn btn-default btn-sm btn-flat">
                        <i class="fa fa-arrow-left"></i> KEMBALI
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td><b>NAMA ANGGOTA</b></td>
                        <td>: {{ $pinjaman->anggota->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><b>JUMLAH PINJAMAN</b></td>
                        <td>: {{ $pinjaman->kategori_pinjaman->nama_kategori ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><b>ANGSURAN SELAMA</b></td>
                        <td>: {{ $pinjaman->kategori_angsuran->bulan }} Bulan</td>
                    </tr>
                    <tr>
                        <td><b>CICILAN PER BULAN</b></td>
                        <td>: Rp.{{ number_format($pinjaman->kategori_angsuran->nominal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><b>TOTAL BAYAR</b></td>
                        <td>: Rp.{{ number_format($pinjaman->kategori_angsuran->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><b>ANGUNAN/JAMINAN</b></td>
                        <td>: {{ $pinjaman->angunan }}</td>
                    </tr>
                    <tr>
                        <td><b>BUKTI ANGUNAN</b></td>
                        <td>
                            @if ($pinjaman->bukti_angunan)
                                <img src="{{ asset('storage/' . $pinjaman->bukti_angunan) }}" alt="Foto Anggota"
                                    class="img-thumbnail" width="50px">
                            @else
                                <p>Tidak ada foto</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>TANGGAL PINJAM</b></td>
                        <td>: {{ date('d-m-Y', strtotime($pinjaman->tanggal_pinjam)) ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><b>STATUS PENGAJUAN</b></td>
                        <td>:
                            @if ($pinjaman->status_pengajuan == 'Pending')
                                <span class="label label-warning"><i class="fa fa-clock-o"></i> Pending</span>
                            @elseif ($pinjaman->status_pengajuan == 'Approved')
                                <span class="label label-success"><i class="fa fa-check"></i> Approved</span>
                            @elseif ($pinjaman->status_pengajuan == 'Rejected')
                                <span class="label label-danger"><i class="fa fa-close"></i> Rejected</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">ANGSURAN PINJAMAN</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" width="15%">ANGSURAN KE</th>
                            <th class="text-center">TANGGAL JATUH TEMPO</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">NOMINAL</th>
                            <th class="text-center" width="20%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($angsuran as $angsuran_item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ date('d-m-Y', strtotime($angsuran_item->tgl_jatuh_tempo)) ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($angsuran_item->status == 'Belum Bayar')
                                        <span class="label label-warning label-flat">Belum Bayar</span>
                                    @elseif ($angsuran_item->status == 'Terlambat')
                                        <span class="label label-danger label-flat">Terlambat</span>
                                    @elseif ($angsuran_item->status == 'Lunas')
                                        <span class="label label-success label-flat">Lunas</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    Rp.{{ number_format($angsuran_item->pinjaman->kategori_angsuran->nominal, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    @if ($angsuran_item->status == 'Belum Bayar' || $angsuran_item->status == 'Terlambat')
                                        <a href="{{ route('angsuran.bayar', $angsuran_item->id) }}"
                                            class="btn btn-sm btn-success btn-flat">
                                            <i class="fa fa-usd"></i> BAYAR
                                        </a>
                                    @elseif ($angsuran_item->status == 'Lunas')
                                        <a href="{{ route('pembayaran.download', $angsuran_item->id) }}"
                                            class="btn btn-sm btn-default btn-flat">
                                            <i class="fa fa-print"></i> PRINT
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>

@endsection
