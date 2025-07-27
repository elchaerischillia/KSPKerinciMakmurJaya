@extends('layouts.main')

@section('title', 'Edit Data Daftar Anggota Simpan')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            EDIT DATA DAFTAR ANGGOTA SIMPAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('simpan.index') }}">DATA DAFTAR ANGGOTA SIMPAN</a></li>
            <li class="active">EDIT DATA DAFTAR ANGGOTA SIMPAN</li>
        </ol>
    </section>
    <!-- /.breadcrumb-->

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Edit Data</h3>
            </div>
            <form action="{{ route('simpan.update', $simpanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menggunakan PUT untuk update data -->
                <div class="box-body">
                    <div class="col-md-6">
                        <!-- Anggota -->
                        <div class="form-group">
                            <label for="anggota_id">ANGGOTA <span class="text-red">*</span></label>
                            <select name="anggota_id" id="anggota_id" class="form-control select2">
                                <option value="" disabled>-- PILIH ANGGOTA --</option>
                                @foreach ($anggota as $angggota_item)
                                    <option value="{{ $angggota_item->id }}"
                                        {{ $simpanan->anggota_id == $angggota_item->id ? 'selected' : '' }}>
                                        {{ $angggota_item->nama_lengkap }} - {{ $angggota_item->nik }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <!-- Kategori Simpan -->
                        <div class="form-group">
                            <label for="kategori_simpan_id">KATEGORI SIMPAN <span class="text-red">*</span></label>
                            <select name="kategori_simpan_id" id="kategori_simpan_id" class="form-control select2">
                                <option value="" disabled>-- PILIH KATEGORI SIMPAN --</option>
                                @foreach ($kategori_simpan as $kategori_simpan_item)
                                    <option value="{{ $kategori_simpan_item->id }}"
                                        {{ $simpanan->kategori_simpan_id == $kategori_simpan_item->id ? 'selected' : '' }}>
                                        {{ $kategori_simpan_item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_simpan_id')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                    

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">STATUS <span class="text-red">*</span></label>
                            <select class="form-control select2" name="status">
                                <option value="" disabled selected>-- PILIH STATUS --</option>
                                <option value="1" {{ old('status', $simpanan->status) == 1 ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ old('status', $simpanan->status) == 0 ? 'selected' : '' }}>Tidak
                                    Aktif
                                </option>
                            </select>
                            @error('status')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-6">

                        <!-- nominal -->
                        <div class="form-group">
                            <label for="nominal">DEPOSITO <span class="text-red">*</span></label>
                            <!-- Menggunakan transaksi_simpan yang sudah diambil pertama -->
                            <input type="text" class="form-control" id="rupiah_format"
                                value="{{ number_format($simpanan->saldo, 0, ',', '.') }}"
                                onkeyup="formatRupiah(this)">
                            <input type="hidden" id="rupiah" name="saldo" value="{{ $simpanan->saldo }}">

                            @error('saldo')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>



                        <!-- Metode Pembayaran -->
                        <div class="form-group">
                            <label for="metode_pembayaran">METODE PEMBAYARAN <span class="text-red">*</span></label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control select2">
                                <option value="" disabled>-- PILIH METODE --</option>
                                <option value="Cash"
                                    {{ $transaksi_simpan->metode_pembayaran == 'Cash' ? 'selected' : '' }}>CASH
                                </option>
                                <option value="Transfer"
                                    {{ $transaksi_simpan->metode_pembayaran == 'Transfer' ? 'selected' : '' }}>
                                    TRANSFER</option>
                            </select>
                            @error('metode_pembayaran')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="form-group">
                            <label for="keterangan">KETERANGAN</label>
                            <textarea name="keterangan" id="keterangan" cols="10" rows="5" class="form-control">{{ $transaksi_simpan->keterangan }}</textarea>
                            @error('keterangan')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> UPDATE</button>
                    <a href="{{ route('simpan.index') }}" class="btn btn-default btn-flat"><i class="fa fa-arrow-left"></i>
                        KEMBALI</a>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('after_script')
    <script>
        var rupiahFormat = document.getElementById("rupiah_format");
        var rupiah = document.getElementById("rupiah");

        rupiahFormat.addEventListener("keyup", function(e) {
            // Format untuk tampilan
            this.value = formatRupiah(this.value);

            // Set nilai asli tanpa format ke input hidden
            rupiah.value = this.value.replace(/\./g, "").replace("Rp ", "");
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }
            return rupiah ? "Rp " + rupiah : "";
        }
    </script>
@endpush
