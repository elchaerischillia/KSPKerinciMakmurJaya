@extends('layouts.main')

@section('title', 'Edit Kategori Angsuran')

@section('content')
    <!-- breadcrumb -->
    <section class="content-header">
        <h1>DATA ANGGOTA</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('anggota.index') }}">DATA ANGGOTA</a></li>
            <li class="active">EDIT DATA ANGGOTA</li>
        </ol>
    </section>
    <!-- /.breadcrumb -->

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">EDIT KATEGORI ANGSURAN</h3>
            </div>
            <form action="{{ route('kategori-angsuran.update', $kategoriAngsuran->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="col-md-6">
                        <!-- KATEGORI PINJAMAN -->
                        <div class="form-group">
                            <label for="kategori_pinjaman_id">KATEGORI PINJAMAN <span class="text-red">*</span></label>
                            <select name="kategori_pinjaman_id" id="kategori_pinjaman_id" class="form-control select2">
                                <option value="" disabled>-- PILIH KATEGORI PINJAMAN --</option>
                                @foreach($kategori_pinjaman as $kp)
                                    <option value="{{ $kp->id }}" {{ $kategoriAngsuran->kategori_pinjaman_id == $kp->id ? 'selected' : '' }}>
                                        {{ $kp->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_pinjaman_id')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- BULAN -->
                        <div class="form-group">
                            <label for="bulan">ANGSURAN SELAMA (BULAN) <span class="text-red">*</span></label>
                            <input type="number" class="form-control" name="bulan" value="{{ old('bulan', $kategoriAngsuran->bulan) }}" required>
                            @error('bulan')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- NOMINAL -->
                        <div class="form-group">
                            <label for="nominal">BAYARAN PER BULAN <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="nominal" id="rupiah" value="{{ old('nominal', $kategoriAngsuran->nominal) }}">
                            @error('nominal')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UPDATE</button>
                    <a href="{{ route('kategori-angsuran.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> KEMBALI</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('after_script')
    <script>
        var rupiah = document.getElementById("rupiah");
        rupiah.addEventListener("keyup", function(e) {
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
@endpush
