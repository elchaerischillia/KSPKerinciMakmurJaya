@extends('layouts.main')

@section('title', 'Daftar Galeri')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DATA GALERI KOPERASI
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA GALERI KOPERASI</li>
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
                <h3 class="box-title">DAFTAR DATA GALERI</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('galeri.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH DATA GALERI
                    </a>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>TANGGAL DIBUAT</th>
                            <th>JUDUL</th>
                            <th>FOTO</th>
                            <th>DESKRIPSI</th>
                            <th class="text-center" width="25%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galeris as $galeri)
                            <tr data-entry-id="{{ $galeri->id }}">
                                <td>{{ date('d-m-Y H:i', strtotime($galeri->created_at)) }}</td>
                                <td>{{ $galeri->judul }}</td>
                                <td>
                                    @if ($galeri->foto)
                                        <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" width="80">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($galeri->deskripsi), 50, '...') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('galeri.edit', $galeri->id) }}"
                                        class="btn btn-sm btn-warning btn-flat">
                                        <i class="fa fa-edit"></i> EDIT
                                    </a>
                                    <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" style="display:inline-block">
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
                                <td colspan="5" class="text-center">Belum ada data galeri.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section>
@endsection
