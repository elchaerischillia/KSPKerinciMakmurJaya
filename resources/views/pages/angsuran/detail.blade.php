@extends('layouts.main')

@section('title', 'Detail Angsuran')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DETAIL ANGSURAN - {{ $angsuran->pinjaman->anggota->nama_lengkap }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('angsuran-bermasalah.index') }}">DATA ANGSURAN BERMASALAH</a></li>
            <li class="active">DETAIL PINJAMAN</li>
        </ol>
    </section>
    <!-- /.breadcrumb-->


    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">IDENTITAS ANGGOTA PEMINJAMAN</span> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>NIK</td>
                                <td>: {{ $angsuran->pinjaman->anggota->nik }}</td>
                            </tr>
                            <tr>
                                <td>NAMA LENGKAP</td>
                                <td>: {{ $angsuran->pinjaman->anggota->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td>ALAMAT</td>
                                <td>: {{ $angsuran->pinjaman->anggota->alamat }}</td>
                            </tr>
                            <tr>
                                <td>NO TELEPON / WA</td>
                                <td>: {{ $angsuran->pinjaman->anggota->no_hp }}</td>
                            </tr>
                            <tr>
                                <td>BANK</td>
                                <td>: {{ $angsuran->pinjaman->anggota->nama_bank }}</td>
                            </tr>
                            <tr>
                                <td>NO REKENING</td>
                                <td>: {{ $angsuran->pinjaman->anggota->no_rek }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><a href="{{ route('angsuran-bermasalah.index') }}"
                                        class="btn btn-block btn-default btn-flat"> <i class="fa fa-arrow-left"></i>
                                        KEMBALI</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">DATA PEMINJAMAN</span> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>JUMLAH PINJAMAN</td>
                                <td>: {{ $angsuran->pinjaman->kategori_pinjaman->nama_kategori ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>ANGSURAN SELAMA</td>
                                <td>: {{ $angsuran->pinjaman->kategori_angsuran->bulan }} Bulan</td>
                            </tr>
                            <tr>
                                <td>CICILAN PER BULAN</td>
                                <td>: Rp.{{ number_format($angsuran->pinjaman->kategori_angsuran->nominal, 0, ',', '.') }}
                            </tr>
                            <tr>
                                <td>TOTAL BAYAR</td>
                                <td>: Rp.{{ number_format($angsuran->pinjaman->kategori_angsuran->total_bayar, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>ANGUNAN</td>
                                <td>: {{ $angsuran->pinjaman->angunan }}</td>
                            </tr>
                            <tr>
                                <td>TANGGAL PINJAM</td>
                                <td>: {{ date('d-m-Y', strtotime($angsuran->pinjaman->tanggal_pinjam)) ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>TANGGAL JATUH TEMPO</td>
                                <td>: {{ date('d-m-Y', strtotime($angsuran->tgl_jatuh_tempo)) ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>STATUS </td>
                                <td>{{ $angsuran->status }}</td>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
