<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                @if (Auth::user()->detail_user && Auth::user()->detail_user->foto)
                    <img src="{{ asset('storage/' . Auth::user()->detail_user->foto) }}" alt="User Image"
                        class="img-circle" width="40px">
                @else
                    <img src="{{ asset('logo/logo-default.png') }}" class="user-image" alt="Default User Image" />
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->nama_lengkap }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>{{ Auth::user()->role }}</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            

            <!-- Dashboard -->
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
                </a>
            </li>

            @if (Auth::user()->role == 'Manager' || Auth::user()->role == 'Teller' )
                <!-- Master Data -->
                <li
                    class="treeview {{ Request::is('karyawan*', 'anggota*', 'kategori-simpan*', 'kategori-pinjaman*', 'kategori-angsuran*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-folder"></i>
                        <span>MASTER DATA</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @if (Auth::user()->role == 'Manager')
                            <li class="{{ Request::routeIs('karyawan.index') ? 'active' : '' }}">
                                <a href="{{ route('karyawan.index') }}"><i class="fa fa-circle-o"></i> DATA KARYAWAN</a>
                            </li>
                        @endif
                        <li class="{{ Request::routeIs('anggota.index') ? 'active' : '' }}">
                            <a href="{{ route('anggota.index') }}"><i class="fa fa-circle-o"></i> DATA NASABAH</a>
                        </li>
                        <li class="{{ Request::routeIs('kategori-simpan.index') ? 'active' : '' }}">
                            <a href="{{ route('kategori-simpan.index') }}"><i class="fa fa-circle-o"></i> DATA KATEGORI
                                SIMPANAN</a>
                        </li>
                        <li class="{{ Request::routeIs('kategori-pinjaman.index') ? 'active' : '' }}">
                            <a href="{{ route('kategori-pinjaman.index') }}"><i class="fa fa-circle-o"></i> DATA
                                KATEGORI
                                PINJAMAN</a>
                        </li>
                        <li class="{{ Request::routeIs('kategori-angsuran.index') ? 'active' : '' }}">
                            <a href="{{ route('kategori-angsuran.index') }}"><i class="fa fa-circle-o"></i> DATA
                                KATEGORI
                                ANGSURAN</a>
                        </li>
                    </ul>
                </li>
            @endif

         @if (Auth::user()->role == 'Manager' || Auth::user()->role == 'Teller')
            <!-- Operational -->
            <li class="treeview {{ Request::is('simpan*', 'pinjaman*', 'angsuran-bermasalah*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>OPERATIONAL</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->role == 'Manager' || Auth::user()->role == 'Teller')
                        <li class="{{ Request::routeIs('simpan.index') ? 'active' : '' }}">
                            <a href="{{ route('simpan.index') }}"><i class="fa fa-circle-o"></i> SIMPAN</a>
                        </li>
                        <li class="{{ Request::routeIs('pinjaman.index') ? 'active' : '' }}">
                            <a href="{{ route('pinjaman.index') }}"><i class="fa fa-circle-o"></i> PINJAM</a>
                        </li>
                    @endif
                    <li class="{{ Request::routeIs('angsuran-bermasalah.index') ? 'active' : '' }}">
                        <a href="{{ route('angsuran-bermasalah.index') }}"><i class="fa fa-circle-o"></i> ANGSURAN
                            BERMASALAH</a>
                    </li>
                </ul>
            </li>
            @endif

          @if (Auth::user()->role == 'Collector' )
    <!-- Operational -->
    <li class="treeview {{ Request::is( 'angsuran-bermasalah*') ? 'active' : '' }}">
        ...
        @if (Auth::user()->role == 'Collector' )
            <li class="{{ Request::routeIs('angsuran-bermasalah.index') ? 'active' : '' }}">
                <a href="{{ route('angsuran-bermasalah.index') }}">
                    <i class="fa fa-circle-o"></i> ANGSURAN BERMASALAH
                </a>
            </li>
        </ul>
    </li>
@endif

            @endif


            

                          @if (Auth::user()->role == 'Manager' || Auth::user()->role == 'Teller')
                <li
                    class="treeview {{ Request::is('laporan/peminjaman*', 'laporan/simpanan*', 'laporan/angsuran*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>LAPORAN</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::routeIs('laporan.peminjaman') ? 'active' : '' }}">
                            <a href="{{ route('laporan.peminjaman') }}"><i class="fa fa-circle-o"></i> LAPORAN
                                PEMINJAMAN</a>
                        </li>
                        <li class="{{ Request::routeIs('laporan.simpanan') ? 'active' : '' }}">
                            <a href="{{ route('laporan.simpanan') }}"><i class="fa fa-circle-o"></i> LAPORAN
                                SIMPANAN</a>
                        </li>
                        <li class="{{ Request::routeIs('laporan.angsuran') ? 'active' : '' }}">
                            <a href="{{ route('laporan.angsuran') }}"><i class="fa fa-circle-o"></i> LAPORAN
                                ANGSURAN</a>
                        </li>
                    </ul>
                </li>
            @endif




            <!-- ADMIN -->

            <!-- tentang -->
         @if (Auth::user()->role == 'Admin' )
            <!-- Operational -->
             <li class="treeview {{ Request::is('tentang*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Tentang</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     @if (Auth::user()->role == 'Admin' )
                        <li class="{{ Request::routeIs('tentang.index') ? 'active' : '' }}">
                            <a href="{{ route('tentang.index') }}"><i class="fa fa-circle-o"></i>  Tentang</a>
                        </li>
                        <li class="{{ Request::routeIs('tentang.create') ? 'active' : '' }}">
                            <a href="{{ route('tentang.create') }}"><i class="fa fa-circle-o"></i> Tambah</a>
                        </li>
                    @endif
                   
                </ul>
            </li>
            @endif

             @if (Auth::user()->role == 'Admin' )
            <!-- Operational -->
             <li class="treeview {{ Request::is('struktur*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Struktur</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     @if (Auth::user()->role == 'Admin' )
                        <li class="{{ Request::routeIs('struktur.index') ? 'active' : '' }}">
                            <a href="{{ route('struktur.index') }}"><i class="fa fa-circle-o"></i> Struktur</a>
                        </li>
                        <li class="{{ Request::routeIs('struktur.create') ? 'active' : '' }}">
                            <a href="{{ route('struktur.create') }}"><i class="fa fa-circle-o"></i> Tambah</a>
                        </li>
                    @endif
                   
                </ul>
            </li>
            @endif



         @if (Auth::user()->role == 'Admin' )
            <!-- Operational -->
             <li class="treeview {{ Request::is('kontak*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Kontak</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     @if (Auth::user()->role == 'Admin' )
                        <li class="{{ Request::routeIs('kontak.index') ? 'active' : '' }}">
                            <a href="{{ route('kontak.index') }}"><i class="fa fa-circle-o"></i> Kontak</a>
                        </li>
                        <li class="{{ Request::routeIs('kontak.create') ? 'active' : '' }}">
                            <a href="{{ route('kontak.create') }}"><i class="fa fa-circle-o"></i> Tambah</a>
                        </li>
                    @endif
                   
                </ul>
            </li>
            @endif

     
          @if (Auth::user()->role == 'Admin' )
            <!-- Operational -->
             <li class="treeview {{ Request::is('galeri*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Galeri</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     @if (Auth::user()->role == 'Admin' )
                        <li class="{{ Request::routeIs('galeri.index') ? 'active' : '' }}">
                            <a href="{{ route('galeri.index') }}"><i class="fa fa-circle-o"></i> Galeri</a>
                        </li>
                        <li class="{{ Request::routeIs('galeri.create') ? 'active' : '' }}">
                            <a href="{{ route('galeri.create') }}"><i class="fa fa-circle-o"></i> Tambah</a>
                        </li>
                    @endif
                   
                </ul>
            </li>
            @endif
     
        

        @if (Auth::user()->role == 'Admin' )
            <!-- Operational -->
             <li class="treeview {{ Request::is('pengumuman*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Pengumuman</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     @if (Auth::user()->role == 'Admin' )
                        <li class="{{ Request::routeIs('pengumuman.index') ? 'active' : '' }}">
                            <a href="{{ route('pengumuman.index') }}"><i class="fa fa-circle-o"></i> Pengumuman</a>
                        </li>
                        <li class="{{ Request::routeIs('pengumuman.create') ? 'active' : '' }}">
                            <a href="{{ route('pengumuman.create') }}"><i class="fa fa-circle-o"></i> Tambah</a>
                        </li>
                    @endif
                   
                </ul>
            </li>
            @endif
     
        @if (Auth::user()->role == 'Admin' )
            <!-- Operational -->
             <li class="treeview {{ Request::is('faq*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Faq</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     @if (Auth::user()->role == 'Admin' )
                        <li class="{{ Request::routeIs('faq.index') ? 'active' : '' }}">
                            <a href="{{ route('faq.index') }}"><i class="fa fa-circle-o"></i> Faq</a>
                        </li>
                        <li class="{{ Request::routeIs('faq.create') ? 'active' : '' }}">
                            <a href="{{ route('faq.create') }}"><i class="fa fa-circle-o"></i> Tambah</a>
                        </li>
                    @endif
                   
                </ul>
            </li>
            @endif
     

        </ul>
    </section>
</aside>
