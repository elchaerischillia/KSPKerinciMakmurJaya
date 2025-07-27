@extends('layouts.main')

@section('title', 'Edit Karyawan')

@section('content')

    <!-- Breadcrumb Section -->
    <section class="content-header">
        <h1>KARYAWAN</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('karyawan.index') }}">DATA KARYAWAN</a></li>
            <li class="active">EDIT DATA KARYAWAN</li>
        </ol>
    </section>
    <!-- /.breadcrumb -->

    <section class="content">
        <div class="row">
            <!-- Form to edit employee -->
            <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">EDIT DATA KARYAWAN</h3>
                        </div>
                        <div class="box-body">

                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="nama_lengkap">NAMA LENGKAP <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}" required>
                                @error('nama_lengkap')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tempat Lahir -->
                            <div class="form-group">
                                <label for="tmpt_lahir">TEMPAT LAHIR <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="tmpt_lahir" value="{{ old('tmpt_lahir', $karyawan->tmpt_lahir) }}">
                                @error('tmpt_lahir')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="form-group">
                                <label for="tgl_lahir">TANGGAL LAHIR <span class="text-red">*</span></label>
                                <input type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir', $karyawan->tgl_lahir) }}">
                                @error('tgl_lahir')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="form-group">
                                <label for="jk">GENDER <span class="text-red">*</span></label>
                                <select class="form-control select2" name="jk">
                                    <option value="" disabled>-- PILIH GENDER --</option>
                                    <option value="Laki-laki" {{ old('jk', $karyawan->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jk', $karyawan->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jk')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Nomor HP -->
                            <div class="form-group">
                                <label for="no_hp">NO TELEPON / WA <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}">
                                @error('no_hp')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="form-group">
                                <label for="alamat">ALAMAT LENGKAP <span class="text-red">*</span></label>
                                <textarea class="form-control" name="alamat" rows="3">{{ old('alamat', $karyawan->alamat) }}</textarea>
                                @error('alamat')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Foto -->
                            <div class="form-group">
                                <label for="foto">FOTO</label>
                                <input type="file" class="form-control" name="foto" accept="image/jpeg, image/png">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti.</small>
                                @if ($karyawan->foto)
                                    <br><img src="{{ asset('storage/' . $karyawan->foto) }}" alt="Foto" width="100">
                                @endif
                                @error('foto')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">HAK AKSES</h3>
                        </div>
                        <div class="box-body">

                            <!-- Username -->
                            <div class="form-group">
                                <label for="username">USERNAME <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="username" value="{{ old('username', $karyawan->username) }}">
                                @error('username')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="form-group">
                                <label for="role">ROLE <span class="text-red">*</span></label>
                                <select class="form-control select2" name="role">
                                    <option value="" disabled>-- PILIH ROLE --</option>
                                    <option value="Manager" {{ old('role', $karyawan->role) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="Teller" {{ old('role', $karyawan->role) == 'Teller' ? 'selected' : '' }}>Teller</option>
                                    <option value="Collector" {{ old('role', $karyawan->role) == 'Collector' ? 'selected' : '' }}>Debt Collector</option>
                                </select>
                                @error('role')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat">
                                <i class="fa fa-save"></i> UPDATE
                            </button>
                            <a href="{{ route('karyawan.index') }}" class="btn btn-default btn-flat">
                                <i class="fa fa-arrow-left"></i> KEMBALI
                            </a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection
