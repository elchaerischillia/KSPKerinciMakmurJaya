@extends('layouts.main')

@section('title', 'Tambah Pengumuman')

@section('content')

    <section class="content-header">
        <h1>
            TAMBAH DATA PENGUMUMAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">TAMBAH DATA PENGUMUMAN</li>
        </ol>
    </section>

    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="box box-primary">
            <form action="{{ route('pengumuman.store') }}" method="POST">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Isi Pengumuman</label>
                        <textarea name="isi" class="form-control" rows="4" required>{{ old('isi') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">- Pilih Status -</option>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">SIMPAN</button>
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-default btn-flat">BATAL</a>
                </div>
            </form>
        </div>
    </section>

@endsection
