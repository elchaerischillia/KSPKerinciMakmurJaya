@extends('layouts.main')

@section('title', 'Daftar Struktur')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DATA STRUKTUR KOPERASI
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA STRUKTUR KOPERASI</li>
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
                <h3 class="box-title">DAFTAR DATA STRUKTUR</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('struktur.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH DATA STRUKTUR
                    </a>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>TANGGAL DIBUAT</th>
                            <th>NAMA</th>
                            <th>FOTO</th>
                            <th class="text-center" width="25%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($strukturs as $struktur)
                            <tr data-entry-id="{{ $struktur->id }}">
                                <td>{{ date('d-m-Y H:i', strtotime($struktur->created_at)) }}</td>
                                <td>{{ $struktur->nama }}</td>
                                <td>
                                    @if ($struktur->foto)
                                        <img src="{{ asset('storage/' . $struktur->foto) }}" alt="{{ $struktur->nama }}" width="80">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('struktur.edit', $struktur->id) }}"
                                        class="btn btn-sm btn-warning btn-flat">
                                        <i class="fa fa-edit"></i> EDIT
                                    </a>
                                    <form action="{{ route('struktur.destroy', $struktur->id) }}" method="POST" style="display:inline-block">
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
                                <td colspan="4" class="text-center">Belum ada data struktur.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section>
@endsection
