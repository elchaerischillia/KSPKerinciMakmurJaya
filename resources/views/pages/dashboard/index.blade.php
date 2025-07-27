@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <!-- breadcrumb -->
    <section class="content-header">
        <h1>
            DASHBOARD
        </h1>
        <ol class="breadcrumb">
            <li class="active">DASHBOARD</li>
        </ol>
    </section>
    <!-- /.breadcrumb-->

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">DATA ANGGOTA</span>
                        <span class="info-box-number" style="margin-top: 10px">{{ $anggota }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-exchange"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">DATA PEMINJAMAN</span>
                        <span class="info-box-number" style="margin-top: 10px">{{ $peminjaman }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-credit-card"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">DATA SIMPANAN</span>
                        <span class="info-box-number" style="margin-top: 10px">{{ $simpanan }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-calendar-times-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ANGSURAN TELAT</span>
                        <span class="info-box-number" style="margin-top: 10px">{{ $angsuran_terlambat }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-orange"><i class="fa fa-money"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TOTAL ANGSURAN</span>
                        <span class="info-box-number" style="margin-top: 10px">Rp. {{ number_format($angsuran, 0, ',', '.') }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green "><i class="fa fa-money"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">TOTAL SIMPANAN</span>
                        <span class="info-box-number" style="margin-top: 10px">Rp. {{ number_format($total_simpanan, 0, ',', '.') }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->


        </div><!-- /.row -->

    </section>
    <!-- /.content -->

@endsection

@push('after_script')

@endpush
