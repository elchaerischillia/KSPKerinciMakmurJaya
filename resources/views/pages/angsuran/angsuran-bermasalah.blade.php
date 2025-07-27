    @extends('layouts.main')

    @section('title', 'Angsuran Bermasalah')

    @section('content')
        <section class="content">
            <div class="box">
                <div class="box-header with-border ">
                    <h3 class="box-title">ANGSURAN PINJAMAN BERMASALAH</h3>
                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center" width="15%">NAMA LENGKAP</th>
                                <th class="text-center">TANGGAL PINJAM</th>
                                <th class="text-center">TANGGAL JATUH TEMPO</th>
                                <th class="text-center">NOMINAL</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center" width="20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($angsuran as $key => $angsuran_item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $angsuran_item->pinjaman->anggota->nama_lengkap ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ date('d-m-Y', strtotime($angsuran_item->pinjaman->tanggal_pinjam)) ?? '-' }}</td>
                                    <td class="text-center">
                                        {{ date('d-m-Y', strtotime($angsuran_item->tgl_jatuh_tempo)) ?? '-' }}</td>

                                    <td class="text-center"> Rp.
                                        {{ number_format($angsuran_item->pinjaman->kategori_angsuran->nominal, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($angsuran_item->status == 'Belum Bayar')
                                            <span class="label label-warning label-flat">Belum Bayar</span>
                                        @elseif ($angsuran_item->status == 'Terlambat')
                                            <span class="label label-danger label-flat ">Terlambat</span>
                                        @elseif ($angsuran_item->status == 'Lunas')
                                            <span class="label label-success label-flat">Lunas</span>
                                        @else
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('angsuran-bermasalah.show', $angsuran_item->id) }}" class="btn btn-sm btn-info btn-flat"><i class="fa fa-eye"></i> DETAIL</a>
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
