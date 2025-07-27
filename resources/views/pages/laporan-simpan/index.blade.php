@extends('layouts.main')

@section('title', 'Laporan Simpanan')

@section('content')
    <section class="content">
        @if (session('error'))
            <div class="alert alert-info  alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                {{ session('error') }}
            </div>
        @endif
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">LAPORAN SIMPANAN</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('laporan.simpanan.cetak-pdf') }}" method="GET">

                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <select name="year" id="year" class="form-control" required>
                                <option value="" disabled {{ old('year', request('year')) ? '' : 'selected' }}>--
                                    PILIH TAHUN --</option>
                                @for ($year = 2020; $year <= now()->year; $year++)
                                    <option value="{{ $year }}"
                                        {{ old('year', request('year')) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="month" id="month" class="form-control" required>
                                <option value="" disabled {{ old('month', request('month')) ? '' : 'selected' }}>--
                                    PILIH BULAN --</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}"
                                        {{ old('month', request('month')) == $month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($month)->monthName }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="action" value="search" class="btn btn-default btn-block btn-flat">
                                <i class="fa fa-search"></i> CARI
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="action" value="print" class="btn btn-default btn-block btn-flat">
                                <i class="fa fa-print"></i> CETAK
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive" style="margin-top: 10px">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>BERGABUNG</th>
                                <th>KARYAWAN</th>
                                <th>ANGGOTA</th>
                                <th>KATEGORI SIMPANAN</th>
                                <th>SALDO</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporan_simpanan as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) ?? '-' }}</td>
                                    <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $item->anggota->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $item->kategori_simpan->nama_kategori ?? '-' }}</td>
                                    <td>
                                        {{ number_format($item->saldo_simpanan, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="text-center">
                    {{ $laporan_simpanan->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
@endsection
