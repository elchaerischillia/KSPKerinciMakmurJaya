@extends('layouts.main')

@section('title', 'Daftar Kontak')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DATA KONTAK KOPERASI
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA KONTAK KOPERASI</li>
        </ol>
    </section>
    <!-- /.breadcrumb-->

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
            <div class="box-header with-border ">
                <h3 class="box-title">DAFTAR DATA KONTAK</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('kontak.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH DATA KONTAK
                    </a>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ALAMAT</th>
                            <th>NO HP</th>
                            <th>EMAIL</th>
                            <th>MAPS</th>
                            <th>JAM BUKA</th>
                            <th class="text-center" width="25%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kontaks as $kontak)
                            <tr data-entry-id="{{ $kontak->id }}">
                                <td>{{ $kontak->alamat }}</td>
                                <td>{{ $kontak->no_hp }}</td>
                                <td>{{ $kontak->email }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($kontak->maps, 50, '...') }}</td>
                                <td>{{ $kontak->jam_buka }}</td>
                                <td class="text-center">
                                    <a href="{{ route('kontak.edit', $kontak->id) }}" class="btn btn-sm btn-warning btn-flat">
                                        <i class="fa fa-edit"></i> EDIT
                                    </a>
                                    <form action="{{ route('kontak.destroy', $kontak->id) }}" method="POST" style="display:inline-block">
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
                                <td colspan="6" class="text-center">Belum ada data kontak.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section>
@endsection
