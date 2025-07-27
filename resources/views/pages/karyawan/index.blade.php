@extends('layouts.main')

@section('title', 'Data Karyawan')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>DATA KARYAWAN</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA KARYAWAN</li>
        </ol>
    </section>

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

        <!-- Data Table -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">LIST DATA KARYAWAN</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('karyawan.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH DATA
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>BERGABUNG</th>
                            <th>NAMA LENGKAP</th>
                            <th>LEVEL</th>
                            <!-- <th class="text-center">STATUS</th> -->
                            <th class="text-center" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $karyawan_item)
                            <tr data-entry-id="{{ $karyawan_item->id }}">
                                <td>{{ date('d-m-Y H:i', strtotime($karyawan_item->created_at)) }}</td>
                                <td>{{ $karyawan_item->nama_lengkap }}</td>
                                <td>{{ $karyawan_item->role }}</td>
                               <!-- <td class="text-center">
    @if (optional($karyawan_item->detail_user)->status == 1)
        <span class="label label-success">Active</span>
    @else
        <span class="label label-danger">Inactive</span>
    @endif
</td> -->

                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-flat">Action</button>
                                        <button type="button" class="btn btn-default btn-flat dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('karyawan.edit', $karyawan_item->id) }}">EDIT</a></li>
                                            <li><a href="{{ route('karyawan.show', $karyawan_item->id) }}">SHOW</a></li>
                                            <li>
                                                <form action="{{ route('karyawan.destroy', $karyawan_item->id) }}" method="POST" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')"
                                                        style="padding: 2px 20px; text-align: left; width: 100%; color: gray; background: none; border: none; cursor: pointer; text-decoration: none;">
                                                        DELETE
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
