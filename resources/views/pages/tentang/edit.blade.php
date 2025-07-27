@extends('layouts.main')

@section('title', 'Edit Tentang')

@section('content')

    <section class="content-header">
        <h1>
            EDIT DATA TENTANG
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="{{ route('tentang.index') }}">DATA TENTANG</a></li>
            <li class="active">EDIT</li>
        </ol>
    </section>

    <section class="content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ups!</strong> Ada kesalahan:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">FORM EDIT DATA</h3>
            </div>

            <form action="{{ route('tentang.update', $tentang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="box-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $tentang->judul) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" class="form-control" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="sejarah" {{ old('jenis', $tentang->jenis) == 'sejarah' ? 'selected' : '' }}>Sejarah</option>
                            <option value="visimisi" {{ old('jenis', $tentang->jenis) == 'visimisi' ? 'selected' : '' }}>Visi Misi</option>
                            <option value="profile" {{ old('jenis', $tentang->jenis) == 'profile' ? 'selected' : '' }}>Profile</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="isi">Isi</label>
                        <textarea name="isi" rows="5" class="form-control" required>{{ old('isi', $tentang->isi) }}</textarea>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> UPDATE</button>
                    <a href="{{ route('tentang.index') }}" class="btn btn-default">BATAL</a>
                </div>

            </form>
        </div>

    </section>

@endsection
