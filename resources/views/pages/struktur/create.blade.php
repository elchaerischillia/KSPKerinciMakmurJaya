@extends('layouts.main')

@section('title', 'Tambah Data Struktur')

@section('content')

    <section class="content-header">
        <h1>
            TAMBAH DATA STRUKTUR
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="{{ route('struktur.index') }}">DATA STRUKTUR</a></li>
            <li class="active">TAMBAH</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">FORM TAMBAH DATA STRUKTUR</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('struktur.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control">
                        @error('foto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success btn-flat">
                        <i class="fa fa-save"></i> SIMPAN
                    </button>
                    <a href="{{ route('struktur.index') }}" class="btn btn-default btn-flat">BATAL</a>
                </form>
            </div>
        </div>
    </section>

@endsection
