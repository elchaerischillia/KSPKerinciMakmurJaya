@extends('layouts.main')

@section('title', 'Detail Pinjaman')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DETAIL PINJAMAN - {{ $pinjaman->anggota->nama_lengkap }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('simpan.index') }}">DATA DAFTAR ANGGOTA PINJAM</a></li>
            <li class="active">DETAIL PINJAMAN</li>
        </ol>
    </section>
    <!-- /.breadcrumb-->


    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">IDENTITAS ANGGOTA PEMINJAMAN</span> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>NIK</td>
                                <td>: {{ $pinjaman->anggota->nik }}</td>
                            </tr>
                            <tr>
                                <td>NAMA LENGKAP</td>
                                <td>: {{ $pinjaman->anggota->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td>ALAMAT</td>
                                <td>: {{ $pinjaman->anggota->alamat }}</td>
                            </tr>
                            <tr>
                                <td>NO TELEPON / WA</td>
                                <td>: {{ $pinjaman->anggota->no_hp }}</td>
                            </tr>
                            <tr>
                                <td>BANK</td>
                                <td>: {{ $pinjaman->anggota->nama_bank }}</td>
                            </tr>
                            <tr>
                                <td>NO REKENING</td>
                                <td>: {{ $pinjaman->anggota->no_rek }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><a href="{{ route('pinjaman.index') }}"
                                        class="btn btn-block btn-default btn-flat"> <i class="fa fa-arrow-left"></i>
                                        KEMBALI</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">DATA PEMINJAMAN</span> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>JUMLAH PINJAMAN</td>
                                <td>: {{ $pinjaman->kategori_pinjaman->nama_kategori ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>ANGSURAN SELAMA</td>
                                <td>: {{ $pinjaman->kategori_angsuran->bulan }} Bulan</td>
                            </tr>
                            <tr>
                                <td>CICILAN PER BULAN</td>
                                <td>: Rp.{{ number_format($pinjaman->kategori_angsuran->nominal, 0, ',', '.') }}
                            </tr>
                            <tr>
                                <td>TOTAL BAYAR</td>
                                <td>: Rp.{{ number_format($pinjaman->kategori_angsuran->total_bayar, 0, ',', '.') }}</td>
                            </tr>

                            <tr>
                                <td>TANGGAL PINJAM</td>
                                <td>: {{ date('d-m-Y', strtotime($pinjaman->tanggal_pinjam)) ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>STATUS PENGAJUAN</td>
                                <td>: @if ($pinjaman->status_pengajuan == 'Pending')
                                        <span class="label label-warning"> <i class="fa fa-clock-o"></i> Pending </span>
                                    @elseif ($pinjaman->status_pengajuan == 'Approved')
                                        <span class="label label-success"> <i class="fa fa-check"></i> Approved </span>
                                    @elseif ($pinjaman->status_pengajuan == 'Rejected')
                                        <span class="label label-danger"> <i class="fa fa-close"></i> Rejected </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                @if (Auth::user()->role == 'Manager' && $pinjaman->status_pengajuan == 'Pending')
                                    <td>
                                        <form action="{{ route('pinjaman.approved', $pinjaman->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-block btn-success btn-flat"
                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui pinjaman ini?')">
                                                <i class="fa fa-check"></i> APPROVE
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('pinjaman.rejected', $pinjaman->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-block btn-danger btn-flat"
                                                onclick="return confirm('Apakah Anda yakin ingin menolak pinjaman ini?')">
                                                <i class="fa fa-close"></i> REJECTED
                                            </button>
                                        </form>
                                    </td>
                                @endif

                            </tr>


                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">BUKTI ANGUNAN</span> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>{{ $pinjaman->angunan }}</th>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    @if ($pinjaman->bukti_angunan)
                                        <img src="{{ asset('storage/' . $pinjaman->bukti_angunan) }}" alt="Foto Anggota"
                                            class="img-thumbnail" width="100px">
                                    @else
                                        <p>Tidak ada foto</p>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
