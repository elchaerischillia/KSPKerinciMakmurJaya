@extends('layouts.main')

@section('title', 'Kategori Pinjaman')

@section('content')

<!-- breadcrumb -->
<section class="content-header">
    <h1>DATA KATEGORI PINJAMAN</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li class="active">DATA KATEGORI PINJAMAN</li>
    </ol>
</section>
<!-- /.breadcrumb-->

<section class="content">
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">DAFTAR KATEGORI PINJAMAN</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#tambahData">
                            <i class="fa fa-plus"></i> TAMBAH DATA
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">NO</th>
                                <th>KATEGORI PINJAMAN</th>
                                <th>JUMLAH PINJAMAN</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori_pinjaman as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>Rp. {{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                                    <td class="text-center" width="20%">
                                        <button type="button" class="btn btn-flat btn-warning btn-sm" data-toggle="modal" data-target="#editData{{ $item->id }}">
                                            <i class="fa fa-pencil"></i> EDIT
                                        </button>

                                        <form action="{{ route('kategori-pinjaman.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-flat btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('kategori-pinjaman.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">TAMBAH KATEGORI PINJAMAN</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">KATEGORI PINJAMAN</label>
                        <input type="text" name="nama_kategori" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pinjaman">JUMLAH PINJAMAN (Rp)</label>
                        <input type="number" name="jumlah_pinjaman" class="form-control" min="100000" step="1000" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-flat btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($kategori_pinjaman as $item)
<div class="modal fade" id="editData{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editDataLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('kategori-pinjaman.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">EDIT KATEGORI PINJAMAN</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">KATEGORI PINJAMAN</label>
                        <input type="text" name="nama_kategori" class="form-control" value="{{ $item->nama_kategori }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pinjaman">JUMLAH PINJAMAN (Rp)</label>
                        <input type="number" name="jumlah_pinjaman" class="form-control" value="{{ $item->jumlah_pinjaman }}" min="100000" step="1000" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-flat btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
