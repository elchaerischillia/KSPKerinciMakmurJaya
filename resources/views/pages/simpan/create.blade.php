@extends('layouts.main')

@section('title', 'Daftar Nasabah Simpan Baru')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            TAMBAH DATA DAFTAR NASABAH SIMPAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('simpan.index') }}">DATA DAFTAR NASABAH SIMPAN</a></li>
            <li class="active">TAMBAH DATA DAFTAR NASABAH SIMPAN</li>
        </ol>
    </section>
    <!-- /.breadcrumb-->

    <section class="content">

        <!-- Alert error -->
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Warning!</h4>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif


        <div class="box box-success">
            <div class="box-header with-border">
                <h3></h3>
            </div>
            <form action="{{ route('simpan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="col-md-6">

                        <!-- Anggota -->
                        <div class="form-group">
                            <label for="anggota_id">NASABAH <span class="text-red">*</span></label>
                            <select name="anggota_id" id="anggota_id" class="form-control select2">
                                <option value="{{ '' }}" disabled selected>-- PILIH ANGGOTA --</option>
                                @foreach ($anggota as $angggota_item)
                                    <option value="{{ $angggota_item->id }}">{{ $angggota_item->nama_lengkap }} -
                                        {{ $angggota_item->nik }}</option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <!-- KATEGORI SIMPAN -->
                        <div class="form-group">
                            <label for="kategori_simpan_id">KATEGORI SIMPAN <span class="text-red">*</span></label>
                            <select name="kategori_simpan_id" id="kategori_simpan_id" class="form-control select2">
                                <option value="{{ '' }}" disabled selected>-- PILIH KATEGORI SIMPAN --</option>
                                @foreach ($kategori_simpan as $kategori_simpan_item)
                                    <option value="{{ $kategori_simpan_item->id }}">
                                        {{ $kategori_simpan_item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_simpan_id')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <!-- SALDO -->
                        <div class="form-group">
                            <label for="saldo_simpanan">DEPOSITO AWAL <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="rupiah" name="saldo_simpanan"
                                placeholder="Rp.">
                            @error('saldo_simpanan')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-6">


                        <!-- METODE PEMBAYARAN -->
                        <div class="form-group">
                            <label for="metode_pembayaran">METODE PEMBAYARAN <span class="text-red">*</span></label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control select2">
                                <option value="{{ '' }}" disabled selected>-- PILIH METODE --</option>
                                <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>CASH
                                </option>
                                <option value="Transfer" {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>
                                    TRANSFER
                                </option>
                            </select>
                            @error('metode_pembayaran')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">KETERANGAN</label>
                            <textarea name="keterangan" id="keterangan" cols="10" rows="5" class="form-control">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                    <a href="{{ route('simpan.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>
                        KEMBALI </a>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('after_script')
    <script>
        var rupiah = document.getElementById("rupiah");
        rupiah.addEventListener("keyup", function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
@endpush
