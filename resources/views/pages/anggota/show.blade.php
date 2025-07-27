@extends('layouts.main')

@section('title', 'Detail Anggota')

@section('content')
    <section class="content-header">
        <h1>DATA ANGGOTA</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('anggota.index') }}">DATA ANGGOTA</a></li>
            <li class="active">DETAIL DATA ANGGOTA</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">DETAIL DATA ANGGOTA</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <th width="30%">NAMA LENGKAP</th>
                                <td>{{ $anggota->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $anggota->nik }}</td>
                            </tr>
                            <tr>
                                <th>TEMPAT LAHIR</th>
                                <td>{{ $anggota->tmpt_lahir ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>TANGGAL LAHIR</th>
                                <td>{{ $anggota->tgl_lahir ? date('d-m-Y', strtotime($anggota->tgl_lahir)) : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>JENIS KELAMIN</th>
                                <td>{{ $anggota->jk }}</td>
                            </tr>
                            <tr>
                                <th>NO TELEPON / WA</th>
                                <td>{{ $anggota->no_hp }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <th>NO REKENING</th>
                                <td>{{ $anggota->nama_bank ?? 'N/A' }} - {{ $anggota->no_rek ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>STATUS</th>
                                <td>
                                    @if ($anggota->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>ALAMAT</th>
                                <td>{{ $anggota->alamat }}</td>
                            </tr>
                            <tr>
                                <th>FOTO</th>
                                <td>
                                    @if ($anggota->foto)
                                        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto Anggota"
                                            class="img-thumbnail" width="150px">
                                    @else
                                        <p>Tidak ada foto</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>TANGGAL MASUK</th>
                                <td>{{ $anggota->created_at ? date('d-m-Y', strtotime($anggota->created_at)) : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="box-footer text-right">
                <a href="{{ route('anggota.index') }}" class="btn btn-default btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </section>
@endsection
