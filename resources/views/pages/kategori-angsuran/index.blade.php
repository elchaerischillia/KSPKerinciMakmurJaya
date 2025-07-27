@extends('layouts.main')

@section('title', 'Data Kategori Angsuran')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>DATA KATEGORI ANGSURAN</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA KATEGORI ANGSURAN</li>
        </ol>
    </section>
    <!-- /.breadcrumb -->

    <!-- Main content -->
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

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">DAFTAR KATEGORI ANGSURAN</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('kategori-angsuran.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH DATA
                    </a>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KATEGORI PINJAMAN</th>
                            <th>ANGSURAN SELAMA (BULAN)</th>
                            <th>BAYARAN PER BULAN</th>
                            <th>TOTAL BAYAR</th>
                            <th class="text-center" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($angsuran as $key => $angsuran_item)
                            <tr data-entry-id="{{ $angsuran_item->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $angsuran_item->kategori_pinjaman->nama_kategori ?? '' }}</td>
                                <td class="text-center">{{ $angsuran_item->bulan ?? '-' }} Bulan</td>
                                <td>Rp.{{ number_format($angsuran_item->nominal, 0, ',', '.') }} / Bulan</td>
                                <td>Rp.{{ number_format($angsuran_item->total_bayar, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <!-- Dropdown for actions -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-flat">Action</button>
                                        <button type="button" class="btn btn-default btn-flat dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ route('kategori-angsuran.edit', $angsuran_item->id) }}">EDIT</a>
                                            </li>
                                            <li>
                                                <!-- Form for DELETE action -->
                                                <form action="{{ route('kategori-angsuran.destroy', $angsuran_item->id) }}"
                                                    method="POST" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori angsuran ini?')"
                                                        style="padding: 2px 20px; text-align: left; width: 100%; color: gray; background: none; border: none; cursor: pointer; text-decoration: none;">
                                                        DELETE
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- End of Dropdown for actions -->
                                </td>
                            </tr>
                        @empty
                            {{-- <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr> --}}
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>

@endsection
