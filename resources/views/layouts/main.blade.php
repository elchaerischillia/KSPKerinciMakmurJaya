<!DOCTYPE html>
<html>
<head>
    <!-- Custom style -->
    <style>
        /* Sidebar biru*/
        .main-sidebar {
            background-color:rgb(85, 124, 172) !important; /* biru */
            color:rgb(236, 232, 232) !important;
            min-height: 100vh;
        }
        .main-sidebar .sidebar a {
            color:rgb(3, 7, 16) !important;
        }
        .main-sidebar .sidebar a:hover {
            background-color: #e0e0e0 !important; /* abu-abu lembut hover */
        }
        .main-sidebar .sidebar .active > a {
            background-color: #e0e0e0 !important; /* abu-abu active */
        }
        .user-panel > .image > img {
            border-radius: 50%;
            border: 2px solid #000000;
        }
        .sidebar-menu .header {
            color: #000000 !important;
        }

        /* Header hijau */
        .main-header,
        .main-header .navbar,
        .main-header .logo {
            background-color:rgb(255, 255, 255) !important; /* cream */
            color:rgb(1, 18, 50) !important; /*kospin*/
        }
        .main-header .navbar a {
            color:rgb(12, 12, 12) !important;
        }
        .main-header .navbar a:hover {
            background-color:rgb(218, 218, 218) !important; /* hijau lebih gelap saat hover */
        }
        .main-header .logo:hover {
            background-color:rgb(226, 231, 226) !important;
        }
        .main-sidebar .sidebar .treeview-menu {
            background-color: transparent !important;
        }


        /* Konten utama teks hitam */
        .content-wrapper,
        .content-wrapper a,
        .info-box-content,
        .info-box-text,
        .info-box-number {
            color: #000000 !important;
        }
    </style>

    <!-- meta -->
    @include('includes.backsite.meta')

    <title>Backoffice | @yield('title')</title>

    <!-- style -->
    @stack('before_style')
    @include('includes.backsite.style')
    @stack('after_style')

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        @include('components.backsite.header')

        <!-- Sidebar -->
        @include('components.backsite.sidebar')

        <!-- Content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('components.backsite.footer')
    </div>

    <!-- script -->
    @stack('before_script')
    @include('includes.backsite.script')
    @stack('after_script')
</body>
</html>
