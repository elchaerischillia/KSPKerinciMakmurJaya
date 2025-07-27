@extends('layouts.main')

@section('title', 'Transaksi Simpan')

@section('content')
    <section class="content-header">
        <h1>PEMBAYARAN ANGSURAN PINJAMAN</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('pinjaman.index') }}">DATA DAFTAR ANGGOTA PINJAMAN</a></li>
            <li class="active">PEMBAYARAN ANGSURAN PINJAMAN</li>
        </ol>
    </section>

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

        <!-- alert error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4> <i class="icon fa fa-check"></i> Error!</h4>
                {{ session('error') }}
            </div>
        @endif
        <!-- /.alert error -->

        <div class="row">
            <!-- Profil Anggota -->
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gray">
                        <div class="widget-user-image">
                            @if ($angsuran->pinjaman->anggota->foto)
                                <img class="img-circle" src="{{ asset('storage/' . $angsuran->pinjaman->anggota->foto) }}"
                                    alt="User Avatar">
                            @else
                                <img class="img-circle" src="{{ asset('logo/logo-default.png') }}" alt="User Avatar">
                            @endif

                        </div><!-- /.widget-user-image -->
                        <h3 class="widget-user-username"><b>{{ $angsuran->pinjaman->anggota->nama_lengkap }}</b></h3>
                        <h5 class="widget-user-desc">NIK :{{ $angsuran->pinjaman->anggota->nik }}</h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#"><b>KATEGORI PINJAMAN</b>: <span
                                        class="pull-right">{{ $angsuran->pinjaman->kategori_pinjaman->nama_kategori }}</span></a>
                            </li>
                            <li><a href="#"><b>NOMINAL</b>: <span class="pull-right">Rp.
                                        {{ number_format($angsuran->pinjaman->kategori_angsuran->nominal, 0, ',', '.') }}</span></a>
                            </li>
                            <li><a href="#"><b>TANGGAL JATUH TEMPO</b>: <span
                                        class="pull-right">{{ date('d-m-Y', strtotime($angsuran->tgl_jatuh_tempo)) }}</span></a>
                            </li>
                            <li><a href="#"><b>STATUS</b>
                                    @if ($angsuran->status == 'Belum Bayar')
                                        <span class="label label-warning label-flat pull-right">Belum Bayar</span>
                                    @elseif ($angsuran->status == 'Terlambat')
                                        <span class="label label-danger label-flat pull-right">Terlambat</span>
                                    @elseif ($angsuran->status == 'Lunas')
                                        <span class="label label-success label-flat pull-right">Lunas</span>
                                    @else
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.widget-user -->
            </div><!-- /.col -->

            <!-- Tab Transaksi -->
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#simpan" data-toggle="tab"><b>TRANSAKSI PEMBAYARAN</b></a></li>
                    </ul>

                    <!-- Tab Bayar -->
                    <div class="tab-content">
                        <div class="active tab-pane" id="simpan">
                            <form action="{{ route('pinjaman.bayar', $angsuran->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Sesuaikan metode PUT -->

                                <!-- Nominal -->
                                <div class="form-group">
                                    <label for="nominal">NOMINAL ANGSURAN <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="rupiah_simpan" name="nominal"
                                        value="{{ old('nominal') }}">
                                    @error('nominal')
                                        <span class="help-block text-red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Metode Pembayaran -->
                                <div class="form-group">
                                    <label for="metode_pembayaran">METODE PEMBAYARAN <span class="text-red">*</span></label>
                                    <select name="metode_pembayaran" class="form-control">
                                        <option value="" disabled selected>-- PILIH METODE --</option>
                                        <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>
                                            CASH</option>
                                        <option value="Transfer"
                                            {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>TRANSFER
                                        </option>
                                    </select>
                                    @error('metode_pembayaran')
                                        <span class="help-block text-red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- BUKTI TRANFER -->
                                <div class="form-group">
                                    <label for="bukti_trans">UPLOAD BUKTI TRANSFER</span> </label>
                                    <input type="file" class="form-control" name="bukti_trans" accept="image/*"
                                        value="{{ old('bukti_trans') }}">
                                    <span class="text-muted"> Upload bukti transfer jika melakukan transfer </span>
                                    @error('bukti_trans')
                                        <span class="help-block text-red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Keterangan -->
                                <div class="form-group">
                                    <label for="keterangan">KETERANGAN</label>
                                    <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <span class="help-block text-red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Button Simpan -->
                                <button type="submit" class="btn btn-success btn-block"
                                    onclick="return confirm('Anda yakin ingin menyimpan dana?')"> <i class="fa fa-usd"></i>
                                    BAYAR</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('after_script')
    <script>
        $(document).ready(function() {
            // Aktifkan tab berdasarkan URL
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab');

            if (activeTab) {
                $('.nav-tabs a[href="#' + activeTab + '"]').tab('show');
            } else {
                $('.nav-tabs a:first').tab('show');
            }

            // Update URL saat tab diubah
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                const newTab = $(e.target).attr('href').substring(1); // Hapus #
                const newUrl = window.location.pathname + '?tab=' + newTab;
                history.replaceState(null, '', newUrl); // Perbarui URL tanpa reload
            });

            // Fungsi untuk navigasi tab
            function navigateTab(direction) {
                const activeTab = $('.nav-tabs li.active');
                let nextTab = null;

                if (direction === 'next') {
                    nextTab = activeTab.next('li:not(.disabled)');
                } else if (direction === 'prev') {
                    nextTab = activeTab.prev('li:not(.disabled)');
                }

                if (nextTab && nextTab.length > 0) {
                    nextTab.find('a[data-toggle="tab"]').tab('show');
                }
            }

            // Event untuk tombol Previous dan Next
            $('#prevTab').on('click', function() {
                navigateTab('prev');
            });

            $('#nextTab').on('click', function() {
                navigateTab('next');
            });
        });


        $(document).ready(function() {
            // Ambil parameter 'tab' dari URL
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab');

            if (activeTab) {
                // Aktifkan tab sesuai parameter 'tab'
                $('.nav-tabs a[href="#' + activeTab + '"]').tab('show');
            } else {
                // Jika tidak ada parameter, aktifkan tab pertama
                $('.nav-tabs a:first').tab('show');
            }

            // Update URL parameter saat tab diubah
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                const newTab = $(e.target).attr('href').substring(1); // Hapus '#'
                const newUrl = window.location.pathname + '?tab=' + newTab;
                history.replaceState(null, '', newUrl); // Update URL tanpa reload halaman
            });
        });

        // Format input menjadi format Rupiah
        const rupiahSimpan = document.getElementById("rupiah_simpan");
        const rupiahTarik = document.getElementById("rupiah_tarik");

        // Fungsi format Rupiah
        function formatRupiah(angka, prefix) {
            let number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            return prefix ? prefix + rupiah : rupiah;
        }

        // Event listener untuk input Simpan
        if (rupiahSimpan) {
            rupiahSimpan.addEventListener("keyup", function(e) {
                rupiahSimpan.value = formatRupiah(this.value, "Rp. ");
            });
        }

        // Event listener untuk input Penarikan
        if (rupiahTarik) {
            rupiahTarik.addEventListener("keyup", function(e) {
                rupiahTarik.value = formatRupiah(this.value, "Rp. ");
            });
        }
    </script>
@endpush
