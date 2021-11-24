@extends('admin.templates.template')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/select2/dist/css/select2.min.css">
    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
            border-radius:0!important;
            border-color:#D2D6DE;
            padding-left: 3px;
        }
        .select2-selection__arrow {
            height: 34px !important;
        }
    </style>
@endsection

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pegawai
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('pegawai') }}"><i class="fa fa-user"></i> Pegawai</a></li>
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
                            <h3 class="box-title">{{ !isset($data) ? 'Tambah' : 'Ubah Data' }} Pegawai</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{route('pegawai.save')}}" class="form-horizontal" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ isset($data) ? $data->id : 0 }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputNama" class="col-sm-2 control-label">Nama Lengkap</label>
                                    
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" required value="{{ isset($data) ? $data->nama : '' }}" class="form-control" id="inputNama" placeholder="[Nama Lengkap]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNIP" class="col-sm-2 control-label">NIP</label>
                                    
                                    <div class="col-sm-10">
                                        <input type="text" name="nip" required value="{{ isset($data) ? $data->nip : '' }}" class="form-control" id="inputNIP" placeholder="[Nomor Induk Pegawai]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputGolRuang" class="col-sm-2 control-label">Gol. Ruang</label>
                                    <div class="col-sm-10">
                                        <select name="id_gol_ruang" required class="form-control gol-ruang js-states" style="width: 100%;" id="inputGolRuang">
                                            <option></option>
                                            @foreach ($gol_ruang as $item)
                                                <option value="{{$item->id}}" {{ isset($data) ? $data->id_gol_ruang == $item->id ? 'selected' : '' : '' }}>{{$item->gol_ruang}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="jabatan" value="{{ isset($data) ? $data->jabatan : '' }}" class="form-control" id="inputJabatan" placeholder="[Jabatan Sekarang]"> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkTerakhir" class="col-sm-2 control-label">SK Terakhir</label>
                                    
                                    <div class="col-sm-10">
                                        <input type="text" name="sk_terakhir" required value="{{ isset($data) ? $data->sk_terakhir : '' }}" class="form-control" id="inputSkTerakhir" placeholder="[SK Terakhir]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTMT" class="col-sm-2 control-label">Nomor/Tanggal/TMT</label>
                                    
                                    <div class="col-sm-10">
                                        <input type="text" name="tmt" required value="{{ isset($data) ? $data->tmt : '' }}" class="form-control" id="inputTMT" placeholder="[Nomor/Tanggal/TMT]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputJabatan" class="col-sm-2 control-label">Jabatan Sekarang</label>
                                    
                                    <div class="col-sm-10">
                                        <select name="id_jabatan" required class="form-control jabatan js-states" style="width: 100%;" id="inputJabatan">
                                            <option></option>
                                            @foreach ($jabatan as $item)
                                                <option value="{{$item->id}}" {{ isset($data) ? $data->id_jabatan == $item->id ? 'selected' : '' : '' }}>{{$item->jabatan}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="jabatan" value="{{ isset($data) ? $data->jabatan : '' }}" class="form-control" id="inputJabatan" placeholder="[Jabatan Sekarang]"> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTmtAkanDatang" class="col-sm-2 control-label">TMT Berkala Akan Datang</label>
                                    
                                    <div class="col-sm-10">
                                        <input type="date" name="tmt_berkala_akan_datang" required value="{{ isset($data) ? $data->tmt_berkala_akan_datang : '' }}" class="form-control" id="inputTmtAkanDatang" placeholder="[Nomor/Tanggal/TMT]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputUnitKerja" class="col-sm-2 control-label">Unit Kerja</label>
                                    <div class="col-sm-10">
                                        <select name="id_unit_kerja" required class="form-control unit-kerja js-states" style="width: 100%;" id="inputUnitKerja">
                                            <option></option>
                                            @foreach ($unit_kerja as $item)
                                                <option value="{{$item->id}}" {{ isset($data) ? $data->id_unit_kerja == $item->id ? 'selected' : '' : '' }}>{{$item->unit_kerja}}</option>
                                            @endforeach
                                        </select>
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
    
@section('script')
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $(function(){
            //Initialize Select2 Elements
            $('.gol-ruang').select2({
                placeholder: "[Pilih Gol. Ruang]",
                allowClear: true
            })
            $('.jabatan').select2({
                placeholder: "[Pilih Jabatan Sekarang]",
                allowClear: true
            })
            $('.unit-kerja').select2({
                placeholder: "[Pilih Unit Kerja]",
                allowClear: true
            })
        })
    </script>
@endsection