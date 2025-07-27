<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   <title>Solusi Keuangan Anda | Koperasi Simpan Pinjam</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <!-- <link href="{{ asset('assets/frontsite/img/favicon.ico') }}" rel="icon"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/frontsite/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/frontsite/css/style.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

    @include('layouts.partials.topbar')
    @include('layouts.partials.navbar')

    @yield('content')

    @include('layouts.partials.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/frontsite/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/frontsite/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/frontsite/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/frontsite/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontsite/js/main.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#jawaban',
        height: 300,
        menubar: false,
        plugins: 'lists link image table paste help wordcount',
        toolbar: 'undo redo | formatselect | ' +
            'bold italic underline | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | table | help',
        content_style: 'body { font-family:Arial,sans-serif; font-size:14px }'
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    @stack('scripts')
</body>
</html>
