@extends('layouts.main')

@section('title', 'Data Nasabah')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DATA NASABAH
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">DATA NASABAH</li>
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
                <h3 class="box-title">DAFTAR DATA NASABAH</h3>

                <div class="box-tools pull-right">
                    <!-- Button to add new member -->
                    <a href="{{ route('anggota.create') }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-plus"></i> TAMBAH DATA
                    </a>
                </div>

            </div><!-- /.box-header -->
            <div class="box-body">
                <!-- Table to display member data -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>BERGABUNG</th>
                            <th>NIK</th>
                            <th>NAMA LENGKAP</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through each anggota (member) -->
                        @forelse ($anggota as $key => $anggota_item)
                            <tr data-entry-id="{{ $anggota_item->id }}">
                                <!-- Displaying join date -->
                                <td>{{ date('d-m-Y H:i', strtotime($anggota_item->created_at)) ?? '' }}</td>
                                <!-- Displaying NIK -->
                                <td>{{ $anggota_item->nik ?? '' }}</td>
                                <!-- Displaying full name -->
                                <td>{{ $anggota_item->nama_lengkap ?? '' }} </td>
                                <td class="text-center">
                                    <!-- Check if the member is active or inactive -->
                                    @if ($anggota_item->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger ">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">

                                    <!-- Button group for actions -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-flat">Action</button>
                                        <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <!-- Edit member -->
                                                <a href="{{ route('anggota.edit', $anggota_item->id) }}">EDIT</a>
                                            </li>
                                            <li>
                                                <!-- View member details -->
                                                <a href="{{ route('anggota.show', $anggota_item->id) }}">SHOW</a>
                                            </li>
                                            <li>
                                                <!-- Form to delete member -->
                                                <form action="{{ route('anggota.destroy', $anggota_item->id) }}" method="POST" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Submit button styled as a link -->
                                                    <button type="submit" class="btn btn-link" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')"
                                                        style="padding: 2px 20px; text-align: left; width: 100%; color: gray; background: none; border: none; cursor: pointer; text-decoration: none;">
                                                        DELETE
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.button group -->

                                </td>
                            </tr>
                        @empty
                            <!-- If there are no members, no data is displayed -->
                            {{-- <td colspan="5">Empty</td> --}}
                        @endforelse
                    </tbody>

                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>

@endsection
