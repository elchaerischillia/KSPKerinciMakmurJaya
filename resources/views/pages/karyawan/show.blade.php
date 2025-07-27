@extends('layouts.main')

@section('title', 'Detail Karyawan')

@section('content')
    <section class="content-header">
        <h1>DETAIL KARYAWAN</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('karyawan.index') }}">DATA KARYAWAN</a></li>
            <li class="active">DETAIL KARYAWAN</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="30%">NAMA LENGKAP</th>
                                <td>{{ $karyawan->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th>USERNAME</th>
                                <td>{{ $karyawan->username }}</td>
                            </tr>
                            <tr>
                                <th>TEMPAT LAHIR</th>
                                <td>{{ $karyawan->detail_user->tmpt_lahir ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>TANGGAL LAHIR</th>
                                <td>{{ date('d-m-Y', strtotime($karyawan->detail_user->tgl_lahir)) ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>TANGGAL BERGABUNG</th>
                                <td>{{ date('d-m-Y', strtotime($karyawan->created_at)) ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>STATUS</th>
                                <td>
                                    @if ($karyawan->detail_user->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Non Active</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>ROLE</th>
                                <td>{{ $karyawan->role }}</td>
                            </tr>
                            <tr>
                                <th>FOTO</th>
                                <td>
                                    @if ($karyawan->detail_user->foto)
                                        <img src="{{ asset('storage/' . $karyawan->detail_user->foto) }}" alt="Foto Karyawan"
                                            class="img-thumbnail" width="150px">
                                    @else
                                        <p>Tidak ada foto</p>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('karyawan.index') }}" class="btn btn-default btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </section>
@endsection
