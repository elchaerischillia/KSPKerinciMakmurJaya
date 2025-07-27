@extends('layouts.main')

@section('title', 'Edit Galeri')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            EDIT DATA GALERI
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="{{ route('galeri.index') }}">DATA GALERI</a></li>
            <li class="active">EDIT DATA GALERI</li>
        </ol>
    </section>
    <!-- /.breadcrumb -->

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">FORM EDIT GALERI</h3>
            </div>

            <div class="box-body">
                <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul">Judul Galeri</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}" required>
                        @error('judul')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Galeri</label>
                        @if ($galeri->foto)
                            <div>
                                <img src="{{ asset('storage/' . $galeri->foto) }}" width="120" alt="{{ $galeri->judul }}">
                            </div>
                        @endif
                        <input type="file" name="foto" class="form-control">
                        @error('foto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    <a href="{{ route('galeri.index') }}" class="btn btn-default">BATAL</a>
                </form>
            </div>
        </div>

    </section>
@endsection
