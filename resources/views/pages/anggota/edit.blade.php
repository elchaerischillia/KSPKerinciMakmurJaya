@extends('layouts.main')

@section('title', 'Edit Nasabah')

@section('content')

    <!-- Breadcrumb -->
    <section class="content-header">
        <h1>DATA NASABAH</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('anggota.index') }}">DATA NASABAH</a></li>
            <li class="active">EDIT DATA NASABAH</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">EDIT DATA NASABAH</h3>
            </div>
            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="col-md-6">

                        <!-- NIK -->
                        <div class="form-group">
                            <label for="nik">NIK <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="nik" value="{{ old('nik', $anggota->nik) }}" required>
                            @error('nik')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- NAMA LENGKAP -->
                        <div class="form-group">
                            <label for="nama_lengkap">NAMA LENGKAP <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" required>
                            @error('nama_lengkap')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- TEMPAT LAHIR -->
                        <div class="form-group">
                            <label for="tmpt_lahir">TEMPAT LAHIR <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="tmpt_lahir" value="{{ old('tmpt_lahir', $anggota->tmpt_lahir) }}">
                            @error('tmpt_lahir')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div class="form-group">
                            <label for="tgl_lahir">TANGGAL LAHIR <span class="text-red">*</span></label>
                            <input type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}">
                            @error('tgl_lahir')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- JENIS KELAMIN -->
                        <div class="form-group">
                            <label for="jk">GENDER <span class="text-red">*</span></label>
                            <select class="form-control select2" name="jk">
                                <option value="" disabled>-- PILIH GENDER --</option>
                                <option value="Laki-laki" {{ old('jk', $anggota->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jk', $anggota->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NO HP -->
                        <div class="form-group">
                            <label for="no_hp">NO TELPON / WA <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $anggota->no_hp) }}">
                            @error('no_hp')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- STATUS -->
                        <div class="form-group">
                            <label for="status">STATUS <span class="text-red">*</span></label>
                            <select class="form-control select2" name="status">
                                <option value="" disabled>-- PILIH STATUS --</option>
                                <option value="1" {{ old('status', $anggota->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $anggota->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-6">

                        <!-- Nama Bank -->
                        <div class="form-group">
                            <label for="nama_bank">NAMA BANK <span class="text-red">*</span></label>
                            <select name="nama_bank" class="form-control select2">
                                <option value="" disabled>-- PILIH BANK --</option>
                                <option value="BRI" {{ old('nama_bank', $anggota->nama_bank) == 'BRI' ? 'selected' : '' }}>BRI</option>
                                <option value="BNI" {{ old('nama_bank', $anggota->nama_bank) == 'BNI' ? 'selected' : '' }}>BNI</option>
                                <option value="MANDIRI" {{ old('nama_bank', $anggota->nama_bank) == 'MANDIRI' ? 'selected' : '' }}>MANDIRI</option>
                                <option value="BCA" {{ old('nama_bank', $anggota->nama_bank) == 'BCA' ? 'selected' : '' }}>BCA</option>
                                <option value="BSI" {{ old('nama_bank', $anggota->nama_bank) == 'BSI' ? 'selected' : '' }}>BSI</option>
                            </select>
                            @error('nama_bank')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- Nomor Rekening -->
                        <div class="form-group">
                            <label for="no_rek">NO REKENING <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="no_rek" value="{{ old('no_rek', $anggota->no_rek) }}">
                            @error('no_rek')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <!-- ALAMAT -->
                        <div class="form-group">
                            <label for="alamat">ALAMAT LENGKAP <span class="text-red">*</span></label>
                            <textarea class="form-control" name="alamat" rows="3">{{ old('alamat', $anggota->alamat) }}</textarea>
                            @error('alamat')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>

                        <p><b>FOTO SAAT INI :</b></p>
                        @if ($anggota->foto)
                            <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto Anggota" width="100px" style="margin-bottom: 20px">
                        @else
                            <p>Tidak ada foto</p>
                        @endif

                        <!-- FOTO -->
                        <div class="form-group">
                            <label for="foto">FOTO BARU</label>
                            <input type="file" class="form-control" name="foto">
                            @error('foto')
                                <span class="help-block text-red"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> KEMBALI</a>
                </div>
            </form>
        </div>
    </section>

@endsection
