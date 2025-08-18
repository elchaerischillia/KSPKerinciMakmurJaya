@extends('layouts.main')

@section('title', 'Daftar Anggota Simpan')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DATA DAFTAR NASABAH SIMPAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA DAFTAR NASABAH SIMPAN</li>
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
                <h3 class="box-title">DAFTAR NASABAH SIMPAN</h3>

                <div class="box-tools pull-right">
                    <a href="{{ route('simpan.create') }}" class="btn btn-success btn-sm btn-flat"><i
                            class="fa fa-plus"></i>
                        TAMBAH NASABAH SIMPAN </a>
                </div>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>BERGABUNG</th>
                            <th>TELLER</th>
                            <th>NASABAH</th>
                            <th>KATEGORI SIMPANAN</th>
                            <th class="text-center">SALDO</th>
                            <th class="text-center" width="30%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($simpanan as $key => $simpanan_item)
                            <tr data-entry-id="{{ $simpanan_item->id }}">
                                <td>{{ date('d-m-Y H:i', strtotime($simpanan_item->created_at)) ?? '-' }}</td>
                                <td>{{ $simpanan_item->user->nama_lengkap ?? '-' }}</td>
                                <td>
                                    {{ $simpanan_item->anggota->nama_lengkap ?? '-' }} <br>
                                     {{ $simpanan_item->anggota->nik ?? '-' }}
                                </td>
                                <td>{{ $simpanan_item->kategori_simpan->nama_kategori ?? '-' }}</td>
                                <td class="text-center">
                                    Rp. {{ number_format($simpanan_item->saldo_simpanan, 0, ',', '.') }}
                                </td>
                                <td class="text-center" width="10%">
    <!-- Tombol Transaksi -->
    <a href="{{ route('simpan.transaksi_simpan', $simpanan_item->id) }}" 
       class="btn btn-xs btn-primary btn-flat" 
       title="Transaksi">
        <i class="fa fa-usd"></i>
    </a>

    <!-- Tombol Delete -->
    <form action="{{ route('simpan.destroy', $simpanan_item->id) }}" 
          method="POST" 
          style="display:inline-block;" 
          onsubmit="return confirm('Yakin ingin menghapus data ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-xs btn-danger btn-flat" 
                title="Hapus">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</td>

                            </tr>
                        @empty
                            {{-- <td colspan="5">Empty</td> --}}
                        @endforelse
                    </tbody>

                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>


@endsection
