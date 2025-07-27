@extends('layouts.main')

@section('title', 'Transaksi Simpan')

@section('content')
    <section class="content-header">
        <h1>TRANSAKSI SIMPAN</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('simpan.index') }}">Daftar Anggota Simpan</a></li>
            <li class="active">TRANSAKSI SIMPAN</li>
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

        <div class="row">
            <!-- Profil Anggota -->
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gray">
                        <div class="widget-user-image">
                            @if ($simpan->anggota->foto)
                                <img class="img-circle" src="{{ asset('storage/' . $simpan->anggota->foto) }}"
                                alt="User Avatar">
                            @else
                                <img class="img-circle" src="{{ asset('logo/logo-default.png') }}"
                                alt="User Avatar">
                            @endif

                        </div><!-- /.widget-user-image -->
                        <h3 class="widget-user-username"><b>{{ $simpan->anggota->nama_lengkap }}</b></h3>
                        <h5 class="widget-user-desc">{{ $simpan->anggota->nik }}</h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#"><b>BANK</b>: <span
                                        class="pull-right">{{ $simpan->anggota->nama_bank }}</span></a></li>
                            <li><a href="#"><b>NO REK</b>: <span
                                        class="pull-right">{{ $simpan->anggota->no_rek }}</span></a></li>
                            <li><a href="#"><b>BERGABUNG</b>: <span
                                        class="pull-right">{{ date('d-m-Y', strtotime($simpan->created_at)) }}</span></a>
                            </li>
                            <li><a href="#"><b>KATEGORI</b>: <span
                                        class="pull-right">{{ $simpan->kategori_simpan->nama_kategori }}</span></a></li>
                            <li><a href="#"><b>STATUS</b>: @if ($simpan->status == 1)
                                        <span class="label label-success pull-right">Active</span>
                                    @else
                                        <span class="label label-danger pull-right">Inactive</span>
                                    @endif
                                </a>
                            </li>
                            <li><a href="#"><b>SALDO</b>: <span class="pull-right">Rp.
                                        {{ number_format($simpan->sum('saldo_simpanan'), 0, ',', '.') }}</span></a></li>
                        </ul>
                    </div>
                </div><!-- /.widget-user -->
            </div><!-- /.col -->

            <!-- Tab Transaksi -->
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#simpan" data-toggle="tab"><i class="fa fa-plus-circle"></i> SIMPAN</a>
                        </li>
                        <li><a href="#penarikan" data-toggle="tab"><i class="fa fa-minus-circle"></i> PENARIKAN</a></li>
                        <li><a href="#history" data-toggle="tab"><i class="fa fa-history"></i> HISTORY</a></li>
                    </ul>


                    <div class="tab-content">

                        <!-- tab Simpan -->
                        <div class="active tab-pane" id="simpan">
                            <form action="{{ route('simpan.tambah_simpan', $simpan->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Sesuaikan metode PUT -->

                                <!-- Nominal -->
                                <div class="form-group">
                                    <label for="nominal">NOMINAL SIMPAN <span class="text-red">*</span></label>
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
                                    onclick="return confirm('Anda yakin ingin menyimpan dana?')"> <i
                                        class="fa fa-arrow-up"></i> SIMPAN
                                    DANA</button>
                            </form>
                        </div>


                        <!-- Tab Penarikan -->
                        <div class="tab-pane" id="penarikan">
                            <form action="{{ route('simpan.penarikan_simpan', $simpan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nominal">NOMINAL PENARIKAN <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="rupiah_tarik" name="nominal"
                                        value="{{ old('nominal') }}">
                                    @error('nominal')
                                        <span class="help-block text-red">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="metode_pembayaran">METODE PEMBAYARAN <span
                                            class="text-red">*</span></label>
                                    <select name="metode_pembayaran" class="form-control">
                                        <option value="" disabled selected>-- PILIH METODE --</option>
                                        <option value="Cash">CASH</option>
                                        <option value="Transfer">TRANSFER</option>
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


                                <div class="form-group">
                                    <label for="keterangan">KETERANGAN</label>
                                    <textarea name="keterangan" class="form-control" rows="2"></textarea>
                                </div>
                                <button type="submit" class="btn btn-warning btn-block"
                                    onclick="return confirm('Anda yakin ingin menarik dana?')"><i
                                        class=" fa fa-arrow-down"></i>
                                    TARIK DANA</button>
                            </form>
                        </div>

                        <!-- Tab History -->
                        <div class="tab-pane" id="history">
                            <div class="content">
                                @forelse ($transaksi_simpan as $transaksi)
                                    <div class="row col-8  mb-4">
                                        <div class="col-8 mb-4">
                                            <div class="box border-{{ $transaksi->status == 1 ? 'success' : 'danger' }}">
                                                <div
                                                    class="box-header bg-{{ $transaksi->jenis_transaksi == 'Simpan' ? 'success' : 'warning' }} text-white d-flex justify-content-between">
                                                    <strong>{{ $transaksi->kode_transaksi }}</strong>
                                                    <div class="pull-right">
                                                        <span
                                                            class="label label-{{ $transaksi->jenis_transaksi == 'Simpan' ? 'success' : 'warning' }} ">
                                                            {{ $transaksi->jenis_transaksi }}</span>

                                                        <a href="{{ route('simpan.download', $transaksi->id) }}"
                                                            class="btn btn-xs btn-flat btn-default">
                                                            <i class="fa fa-print"></i> PRINT
                                                        </a>
                                                    </div>

                                                    <span>{{ date('H:i', strtotime($transaksi->created_at)) }}</span>
                                                </div>
                                                <div class="box-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <strong>TELLER :</strong>
                                                            {{ $transaksi->user->nama_lengkap }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>TANGGAL :</strong>
                                                            {{ date('d-m-Y', strtotime($transaksi->created_at)) }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>NOMINAL :</strong> Rp.
                                                            {{ number_format($transaksi->nominal, 0, ',', '.') }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>METODE PEMBAYARAN:</strong>
                                                            <span
                                                                class="label label-info">{{ $transaksi->metode_pembayaran ?? '-' }}</span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>STATUS:</strong>
                                                            <span
                                                                class="label label-{{ $transaksi->status == 1 ? 'success' : 'danger' }}">
                                                                {{ $transaksi->status == 1 ? 'Berhasil' : 'Gagal' }}
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong> SALDO:</strong>
                                                            Rp.
                                                            {{ number_format($transaksi->saldo_akhir ?? 0, 0, ',', '.') }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>KETERANGAN:</strong>
                                                            {{ $transaksi->keterangan ?? 'Tidak ada keterangan' }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="box-footer text-muted">
                                                    <small>Terakhir diperbarui:
                                                        {{ $transaksi->updated_at->format('d-m-Y H:i') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-info text-center">
                                        <strong>Belum ada transaksi</strong>
                                    </div>
                                @endforelse

                                <!-- Pagination -->
                                <div class="mt-4">
                                    {{ $transaksi_simpan->appends(['tab' => 'history'])->links('pagination::bootstrap-4') }}
                                </div>

                            </div>
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
