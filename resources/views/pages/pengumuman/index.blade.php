@extends('layouts.main')

@section('title', 'Daftar Pengumuman')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DATA PENGUMUMAN KOPERASI
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA PENGUMUMAN KOPERASI</li>
        </ol>
    </section>
    <!-- /.breadcrumb-->

    <!-- Main content -->
    <section class="content">

        <!-- alert success -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4> <i class="icon fa fa-check"></i> Success!</h4>
                {{ session('success') }}
            </div>
        @endif
        <!-- /.alert success -->

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">DAFTAR DATA PENGUMUMAN</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('pengumuman.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH DATA PENGUMUMAN
                    </a>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>TANGGAL DIBUAT</th>
                            <th>JUDUL</th>
                            <th>ISI (RINGKAS)</th>
                            <th>STATUS</th>
                            <th class="text-center" width="25%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengumumen as $pengumuman)
                            <tr data-entry-id="{{ $pengumuman->id }}">
                                <td>{{ date('d-m-Y H:i', strtotime($pengumuman->created_at)) }}</td>
                                <td>{{ $pengumuman->judul }}</td>
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 50, '...') }}</td>
                                <td>
                                    @if ($pengumuman->status === 'aktif')
                                        <span class="label label-success">AKTIF</span>
                                    @else
                                        <span class="label label-danger">TIDAK AKTIF</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pengumuman.edit', $pengumuman->id) }}"
                                        class="btn btn-sm btn-warning btn-flat">
                                        <i class="fa fa-edit"></i> EDIT
                                    </a>
                                    <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat"
                                            onclick="return confirm('Yakin hapus data?')">
                                            <i class="fa fa-trash"></i> HAPUS
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data pengumuman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section>
@endsection
