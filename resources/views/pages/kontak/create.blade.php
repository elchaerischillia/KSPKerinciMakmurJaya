@extends('layouts.main')

@section('title', 'Tambah Kontak')

@section('content')

    <section class="content-header">
        <h1>
            TAMBAH DATA KONTAK
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="{{ route('kontak.index') }}">DATA KONTAK</a></li>
            <li class="active">TAMBAH KONTAK</li>
        </ol>
    </section>

    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">FORM TAMBAH KONTAK</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="maps">Link Maps</label>
                        <input type="text" name="maps" id="maps" class="form-control" value="{{ old('maps') }}">
                    </div>

                    <div class="form-group">
                        <label for="jam_buka">Jam Buka</label>
                        <input type="text" name="jam_buka" id="jam_buka" class="form-control" value="{{ old('jam_buka') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                    <a href="{{ route('kontak.index') }}" class="btn btn-default">BATAL</a>
                </form>
            </div>
        </div>
    </section>

@endsection
