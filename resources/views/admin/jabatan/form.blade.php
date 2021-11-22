@extends('admin.templates.template')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jabatan
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('jabatan') }}"><i class="fa fa-key"></i> Jabatan</a></li>
            <li class="active"><i class="fa fa-{{ !isset($data) ? 'plus' : 'edit'  }}"></i> {{ !isset($data) ? 'Tambah' : 'Ubah' }}</li>
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Jabatan</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{ route('jabatan.save') }}" class="form-horizontal" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ isset($data) ? $data->id : 0 }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputJabatan" class="col-sm-2 control-label">Jabatan</label>
                                    
                                    <div class="col-sm-10">
                                        <input type="text" name="jabatan" value="{{ isset($data) ? $data->jabatan : '' }}" class="form-control" id="inputJabatan" placeholder="[Jabatan]">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-social bg-olive btn-flat pull-right"><i class="fa fa-save"></i>SIMPAN</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
    @endsection
    