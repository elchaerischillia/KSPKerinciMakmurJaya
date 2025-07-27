@extends('layouts.main')

@section('title', 'Daftar Anggota Pinjam')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            TAMBAH DATA DAFTAR ANGGOTA PINJAM
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('simpan.index') }}">DATA DAFTAR ANGGOTA PINJAM</a></li>
            <li class="active">TAMBAH DATA DAFTAR ANGGOTA PINJAM</li>
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
            <form action="{{ route('pinjaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="col-md-6">

                        <!-- Anggota -->
                        <div class="form-group">
                            <label for="anggota_id">ANGGOTA <span class="text-red">*</span></label>
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

                        <!-- JUMLAH PINJAMAN -->
                        <div class="form-group">
                            <label for="kategori_pinjaman_id">JUMLAH PINJAMAN <span class="text-red">*</span></label>
                            <select name="kategori_pinjaman_id" id="kategori_pinjaman_id" class="form-control select2">
                                <option value="" disabled selected>-- PILIH JUMLAH PINJAM --</option>
                                @foreach ($kategori_pinjaman as $kategori_pinjaman_item)
                                    <option value="{{ $kategori_pinjaman_item->id }}">
                                        {{ $kategori_pinjaman_item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_pinjaman_id')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <!-- ANGSURAN -->
                        <div class="form-group">
                            <label for="kategori_angsuran_id">ANGSURAN <span class="text-red">*</span></label>
                            <select name="kategori_angsuran_id" id="kategori_angsuran_id" class="form-control select2">
                                <option value="" disabled selected>-- PILIH ANGSURAN --</option>
                            </select>
                            @error('kategori_angsuran_id')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_pinjam">TANGGAL PINJAM <span class="text-red">*</span></label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control"
                                value="{{ old('tanggal_pinjam') }}">
                            @error('tanggal_pinjam')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="angunan">ANGUNAN <span class="text-red">*</span></label>
                            <input type="text" name="angunan" id="angunan" class="form-control"
                                value="{{ old('angunan') }}">
                            @error('angunan')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bukti_angunan">BUKTI ANGUNAN  <span class="text-red">*</span></label>
                            <input type="file" name="bukti_angunan" id="bukti_angunan" class="form-control"
                                value="{{ old('bukti_angunan') }}">
                            @error('bukti_angunan')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                    <a href="{{ route('pinjaman.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>
                        KEMBALI </a>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('after_script')
    <script>
        $(document).ready(function() {
            $('#kategori_pinjaman_id').change(function() {
                var kategoriPinjamanID = $(this).val();
                if (kategoriPinjamanID) {
                    $.ajax({
                        url: "{{ route('getKategoriAngsuran') }}",
                        type: "POST",
                        data: {
                            kategori_pinjaman_id: kategoriPinjamanID,
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#kategori_angsuran_id').empty();
                            $('#kategori_angsuran_id').append(
                                '<option value="" disabled selected>-- PILIH ANGSURAN --</option>'
                                );
                            $.each(data, function(key, value) {
                                $('#kategori_angsuran_id').append('<option value="' +
                                    value.id + '">' + value.bulan + ' Bulan ' + ' / ' + 'Rp. ' + value.nominal + ' = ' + 'Rp. ' + value.total_bayar +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#kategori_angsuran_id').empty();
                    $('#kategori_angsuran_id').append(
                        '<option value="" disabled selected>-- PILIH ANGSURAN --</option>');
                }
            });
        });
    </script>
@endpush
