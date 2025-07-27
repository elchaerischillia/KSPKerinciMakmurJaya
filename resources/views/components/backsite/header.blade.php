<header class="main-header">

    <!-- Logo -->
   <a href="index2.html" class="logo" title="KOPERASI SIMPAN PINJAM">
    <span class="logo-mini"><b>BO</b></span>
    <span class="logo-lg" style="display: flex; align-items: center;">
        <img src="/images/logo_koperasi.png" alt="Logo Koperasi"
             style="height:40px; margin-right:8px;">
        <span style="font-weight: bold; font-size:25px;"> KSP </span>
    </span>
</a>




    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="confirmLogout(event)">
                        <span class="hidden-xs"><i class="fa fa-sign-out"></i>LOGOUT</span>
                    </a>

                </li>
            </ul>
        </div>
    </nav>
</header>
