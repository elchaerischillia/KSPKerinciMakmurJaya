@extends('layouts.main')

@section('title', 'Tambah FAQ')

@section('content')
    <section class="content-header">
        <h1>
            TAMBAH DATA FAQ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="{{ route('faq.index') }}">DATA FAQ</a></li>
            <li class="active">TAMBAH DATA FAQ</li>
        </ol>
    </section>

    <section class="content">
        <form action="{{ route('faq.store') }}" method="POST">
            @csrf
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">FORM TAMBAH DATA FAQ</h3>
                </div>
                <div class="box-body">
                    {{-- Pertanyaan --}}
                    <div class="form-group">
                        <label>Pertanyaan</label>
                        <input type="text" name="pertanyaan" class="form-control" value="{{ old('pertanyaan') }}" required>
                    </div>

                    {{-- Jawaban (Summernote Editor) --}}
                    <div class="form-group">
                        <label for="jawaban">Jawaban</label>
                        <textarea id="jawaban" name="jawaban" class="form-control">{{ old('jawaban') }}</textarea>
                    </div>

                    {{-- Urutan --}}
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan') }}">
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>AKTIF</option>
                            <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>TIDAK AKTIF</option>
                        </select>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-flat">
                        <i class="fa fa-save"></i> SIMPAN
                    </button>
                    <a href="{{ route('faq.index') }}" class="btn btn-default btn-flat">BATAL</a>
                </div>
            </div>
        </form>
    </section>

    {{-- Summernote CSS & JS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>

    {{-- Inisialisasi Summernote --}}
    <script>
        $(document).ready(function() {
            $('#jawaban').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endsection
