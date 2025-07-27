@extends('layouts.main')

@section('title', 'Edit Data Daftar Anggota Pinjam')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            EDIT DATA DAFTAR ANGGOTA PINJAM
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('pinjaman.index') }}">DATA DAFTAR ANGGOTA PINJAM</a></li>
            <li class="active">EDIT DATA DAFTAR ANGGOTA PINJAM</li>
        </ol>
    </section>
    <!-- /.breadcrumb -->

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
            <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')  <!-- Untuk menggunakan metode PUT untuk update data -->
                <div class="box-body">
                    <div class="col-md-6">

                        <!-- Anggota -->
                        <div class="form-group">
                            <label for="anggota_id">ANGGOTA <span class="text-red">*</span></label>
                            <select name="anggota_id" id="anggota_id" class="form-control select2">
                                <option value="{{ '' }}" disabled>-- PILIH ANGGOTA --</option>
                                @foreach ($anggota as $angggota_item)
                                    <option value="{{ $angggota_item->id }}" {{ $angggota_item->id == $pinjaman->anggota_id ? 'selected' : '' }}>
                                        {{ $angggota_item->nama_lengkap }} - {{ $angggota_item->nik }}</option>
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
                                <option value="" disabled>-- PILIH JUMLAH PINJAM --</option>
                                @foreach ($kategori_pinjaman as $kategori_pinjaman_item)
                                    <option value="{{ $kategori_pinjaman_item->id }}" {{ $kategori_pinjaman_item->id == $pinjaman->kategori_pinjaman_id ? 'selected' : '' }}>
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
                                <option value="" disabled>-- PILIH ANGSURAN --</option>
                                <!-- Pilihan angsuran akan di-update dengan Ajax setelah memilih jumlah pinjaman -->
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
                                value="{{ old('tanggal_pinjam', $pinjaman->tanggal_pinjam) }}">
                            @error('tanggal_pinjam')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="angunan">ANGUNAN <span class="text-red">*</span></label>
                            <input type="text" name="angunan" id="angunan" class="form-control"
                                value="{{ old('angunan', $pinjaman->angunan) }}">
                            @error('angunan')
                                <span class="help-block text-red">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="mb-2">
                                @if ($pinjaman->bukti_angunan)
                                    <p class="mt-2 fw-bold">BUKTI ANGUNAN SAAT INI:</p>
                                    <img src="{{ asset('storage/' . $pinjaman->bukti_angunan) }}" alt="Foto" class="img-thumbnail" style="width: 150px;">
                                @endif
                            </div>
                            <input type="file" class="form-control" name="bukti_angunan" accept="image/jpeg, image/png" style="margin-top: 20px">
                            <small class="text-muted">Hanya format JPG atau PNG yang diperbolehkan.</small>
                            @error('bukti_angunan')
                                <span class="help-block text-danger">{{ $message }}</span>
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
            // Trigger to update angsuran options after selecting jumlah pinjaman
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
                                $('#kategori_angsuran_id').append('<option value="' + value.id + '" ' +
                                    (value.id == '{{ old('kategori_angsuran_id', $pinjaman->kategori_angsuran_id) }}' ? 'selected' : '') +
                                    '>' + value.bulan + ' Bulan ' + ' / ' + 'Rp. ' + value.nominal + ' = ' + 'Rp. ' + value.total_bayar +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#kategori_angsuran_id').empty();
                    $('#kategori_angsuran_id').append('<option value="" disabled selected>-- PILIH ANGSURAN --</option>');
                }
            });

            // Set initial angsuran data based on the current value of kategori_pinjaman_id
            $('#kategori_pinjaman_id').trigger('change');
        });
    </script>
@endpush
