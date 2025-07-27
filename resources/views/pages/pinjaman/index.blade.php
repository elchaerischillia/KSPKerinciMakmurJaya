@extends('layouts.main')

@section('title', 'Daftar Nasabah Pinjam')

@section('content')

    <!-- Breadcrumb -->
    <section class="content-header">
        <h1>DATA NASABAH PINJAM</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA DAFTAR NASABAH PINJAM</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ session('success') }}
            </div>
        @endif

        <!-- Box for Table -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">DAFTAR NASABAH PINJAM</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('pinjaman.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH NASABAH PINJAM
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>BERGABUNG</th>
                            <th>TELLER</th>
                            <th>ANGGOTA</th>
                            <th>TANGGAL PINJAM</th>
                            <th>BESAR PINJAMAN</th>
                            <th class="text-center">ANGSURAN</th>
                            <th>TOTAL BAYAR</th>
                            <th>STATUS</th>
                            <th class="text-center" width="30%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pinjaman as $pinjaman_item)
                            <tr data-entry-id="{{ $pinjaman_item->id }}">
                                <td>{{ date('d-m-Y H:i', strtotime($pinjaman_item->created_at)) ?? '-' }}</td>
                                <td>{{ $pinjaman_item->user->nama_lengkap ?? '-' }}</td>
                                <td>
                                    {{ $pinjaman_item->anggota->nama_lengkap ?? '-' }} <br>
                                    {{ $pinjaman_item->anggota->nik ?? '-' }}
                                </td>
                                <td>{{ $pinjaman_item->tanggal_pinjam ?? '-' }}</td>
                                <td>{{ $pinjaman_item->kategori_pinjaman->nama_kategori ?? '-' }}</td>
                                <td>
                                    {{ $pinjaman_item->kategori_angsuran->bulan ?? '-' }} x Rp.
                                    {{ number_format($pinjaman_item->kategori_angsuran->nominal, 0, ',', '.') }}
                                </td>
                                <td>Rp.{{ number_format($pinjaman_item->kategori_angsuran->total_bayar, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if ($pinjaman_item->status_pengajuan == 'Pending')
                                        <span class="label label-warning"><i class="fa fa-clock-o"></i> Pending</span>
                                    @elseif ($pinjaman_item->status_pengajuan == 'Approved')
                                        <span class="label label-success"><i class="fa fa-check"></i> Approved</span>
                                    @elseif ($pinjaman_item->status_pengajuan == 'Rejected')
                                        <span class="label label-danger"><i class="fa fa-close"></i> Rejected</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($pinjaman_item->status_pengajuan == 'Approved')
                                        <a href="{{ route('pinjaman.transaksi', $pinjaman_item->id) }}"
                                            class="btn btn-sm btn-primary btn-flat">
                                            <i class="fa fa-usd"></i> TRANSAKSI
                                        </a>
                                    @else
                                        <!-- Action Button Group -->
                                        @if (Auth::user()->role == 'Teller')
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-flat">Action</button>
                                                <button type="button" class="btn btn-default btn-flat dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{ route('pinjaman.edit', $pinjaman_item->id) }}">EDIT</a>
                                                    </li>
                                                    <li><a href="{{ route('pinjaman.show', $pinjaman_item->id) }}">SHOW</a>
                                                    </li>
                                                    <li>
                                                        <!-- Form for DELETE action -->
                                                        <form action="{{ route('pinjaman.destroy', $pinjaman_item->id) }}"
                                                            method="POST" style="margin: 0;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')"
                                                                style="padding: 2px 20px; text-align: left; width: 100%; color: gray; background: none; border: none; cursor: pointer; text-decoration: none;">
                                                                DELETE
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                        @if (Auth::user()->role == 'Manager')
                                            <a href="{{ route('pinjaman.show', $pinjaman_item->id) }}"
                                                class="btn btn-sm btn-info btn-flat"><i class="fa fa-eye"></i> DETAIL</a>

                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            {{-- <tr>
                                <td colspan="9" class="text-center">Data tidak ditemukan</td>
                            </tr> --}}
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
