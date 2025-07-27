@extends('layouts.main')

@section('title', 'Daftar Tentang')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DATA TENTANG KOPERASI
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA TENTANG KOPERASI</li>
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
            <div class="box-header with-border ">
                <h3 class="box-title">DAFTAR DATA TENTANG</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('tentang.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH DATA TENTANG
                    </a>
                </div>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>TANGGAL DIBUAT</th>
                            <th>JUDUL</th>
                            <th>JENIS</th>
                            <th>ISI (RINGKAS)</th>
                            <th class="text-center" width="25%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tentangs as $tentang)
                            <tr data-entry-id="{{ $tentang->id }}">
                                <td>{{ date('d-m-Y H:i', strtotime($tentang->created_at)) }}</td>
                                <td>{{ $tentang->judul }}</td>
                                <td>{{ ucfirst($tentang->jenis) }}</td>
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($tentang->isi), 50, '...') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('tentang.edit', $tentang->id) }}"
                                        class="btn btn-sm btn-warning btn-flat">
                                        <i class="fa fa-edit"></i> EDIT
                                    </a>
                                    <form action="{{ route('tentang.destroy', $tentang->id) }}" method="POST" style="display:inline-block">
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
                                <td colspan="5" class="text-center">Belum ada data tentang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section>
@endsection
