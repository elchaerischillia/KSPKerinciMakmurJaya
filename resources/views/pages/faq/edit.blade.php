@extends('layouts.main')

@section('title', 'Edit FAQ')

@section('content')
    <section class="content-header">
        <h1>
            EDIT DATA FAQ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="{{ route('faq.index') }}">DATA FAQ</a></li>
            <li class="active">EDIT DATA FAQ</li>
        </ol>
    </section>

    <section class="content">
        <form action="{{ route('faq.update', $faq->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">FORM EDIT DATA FAQ</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Pertanyaan</label>
                        <input type="text" name="pertanyaan" class="form-control" value="{{ old('pertanyaan', $faq->pertanyaan) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jawaban</label>
                        <textarea name="jawaban" class="form-control" rows="4" required>{{ old('jawaban', $faq->jawaban) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $faq->urutan) }}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="aktif" {{ old('status', $faq->status) == 'aktif' ? 'selected' : '' }}>AKTIF</option>
                            <option value="tidak_aktif" {{ old('status', $faq->status) == 'tidak_aktif' ? 'selected' : '' }}>TIDAK AKTIF</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-save"></i> UPDATE</button>
                    <a href="{{ route('faq.index') }}" class="btn btn-default btn-flat">BATAL</a>
                </div>
            </div>
        </form>
    </section>
@endsection
