@extends('layouts.main')

@section('title', 'Kategori Pinjaman')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DATA KATEGORI PINJAMAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA KATEGORI PINJAMAN</li>
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

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">DAFTAR KATEGORI PINJAMAN</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-flat btn-success btn-sm" data-toggle="modal"
                                data-target="#tambahData"><i class="fa fa-plus"></i> TAMBAH DATA</button>
                        </div>
                    </div>

                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">NO</th>
                                    <th>KATEGORI PINJAMAN</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori_pinjaman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td class="text-center" width="20%">
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-flat btn-warning btn-sm"
                                                data-toggle="modal" data-target="#editData{{ $item->id }}"><i
                                                    class="fa fa-pencil"></i> EDIT
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('kategori-pinjaman.destroy', $item->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-flat btn-sm"
                                                    title="Hapus Kategori"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori pinjaman ini?')">
                                                    <i class="fa fa-trash"></i> DELETE
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahDataLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataLabel">TAMBAH KATEGORI PINJAMAN</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori-pinjaman.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kategori">KATEGORI PINJAMAN</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                                placeholder="Masukkan kategori simpanan" required>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"> <i
                                    class="fa fa-close"></i>TUTUP</button>
                            <button type="submit" class="btn btn-flat btn-success"> <i class="fa fa-save"></i>
                                SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($kategori_pinjaman as $item)
        <div class="modal fade" id="editData{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="tambahDataLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDataLabel">EDIT KATEGORI PINJAMAN</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kategori-pinjaman.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_kategori">KATEGORI PINJAMAN</label>
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                                    placeholder="Masukkan kategori simpanan" value="{{ $item->nama_kategori }}"
                                    required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"> <i
                                        class="fa fa-close"></i>TUTUP</button>
                                <button type="submit" class="btn btn-flat btn-success"> <i class="fa fa-save"></i>
                                    SIMPAN </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
