@extends('admin.templates.template')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        @if (session('status'))
        <div class="alert alert-{!! session('status') !!} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
                {!! session('message') !!}
            </div>
            @endif
            <p>Hallo <strong>{{ \Auth::user()->name }}</strong>, selamat datang di Aplikasi Notif Kenaikan Gaji Berkala Berbasis Web!</p>
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $total_pegawai }}</h3>
                            
                            <p>Total Pegawai</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-people"></i>
                        </div>
                        <a href="{{ route('pegawai') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3>{{ $tmt_akan_berakhir }}</h3>
                            
                            <p>TMT Berkala Akan Berakhir</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-time"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $tmt_berakhir }}</h3>
                            
                            <p>TMT Berkala Telah Berakhir</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-close"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
    @endsection
    