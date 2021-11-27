@extends('admin.templates.template')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
            <li class="active"><i class="fa fa-users"></i> Pegawai</li>
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
                <div class="col-xs-12">      
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div style="margin-bottom: 10px;">
                                <a id="btn-export-pdf" target="_blank" href="{{ route('pegawai.export') . $export_pdf_params }}" class="btn btn-social bg-red btn-flat">
                                    <i class="fa fa-file-pdf-o"></i> Export PDF
                                </a>
                                <a href="{{ route('pegawai.create') }}" class="pull-right btn btn-social bg-blue btn-flat">
                                    <i class="fa fa-plus"></i> TAMBAH
                                </a>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="box box-default collapsed-box" style="margin-top:10px;">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-filter"></i> Filter</h3>
                                    
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <form action="" method="get">

                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <select name="gol_ruang" class="form-control gol-ruang js-states" style="width: 100%;" id="inputGolRuang">
                                                    <option></option>
                                                    @foreach ($gol_ruang as $item)
                                                        <option value="{{$item->id}}" {{ app('request')->input('gol_ruang') ? (app('request')->input('gol_ruang') == $item->id ? 'selected' : '') : (old('id_gol_ruang') == $item->id ? 'selected' : '') }}>{{$item->gol_ruang}}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" name="jabatan" value="{{ isset($data) ? $data->jabatan : '' }}" class="form-control" id="inputJabatan" placeholder="[Jabatan Sekarang]"> --}}
                                            </div>
                                            <div class="col-md-2">
                                                <select name="jabatan" class="form-control jabatan js-states" style="width: 100%;" id="inputJabatan">
                                                    <option></option>
                                                    @foreach ($jabatan as $item)
                                                        <option value="{{$item->id}}" {{ app('request')->input('jabatan') ? (app('request')->input('jabatan') == $item->id ? 'selected' : '') : (old('id_jabatan') == $item->id ? 'selected' : '') }}>{{$item->jabatan}}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" name="jabatan" value="{{ isset($data) ? $data->jabatan : '' }}" class="form-control" id="inputJabatan" placeholder="[Jabatan Sekarang]"> --}}
                                            </div>
                                            <div class="col-md-2">
                                                <select name="unit_kerja" class="form-control unit-kerja js-states" style="width: 100%;" id="inputUnitKerja">
                                                    <option></option>
                                                    @foreach ($unit_kerja as $item)
                                                        <option value="{{$item->id}}" {{ app('request')->input('unit_kerja') ? (app('request')->input('unit_kerja') == $item->id ? 'selected' : '') : (old('id_unit_kerja') == $item->id ? 'selected' : '') }}>{{$item->unit_kerja}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="tmt_berkala" class="form-control tmt-berkala js-states" style="width: 100%;">
                                                    <option value="semua" {{ app('request')->input('tmt_berkala') ? (app('request')->input('tmt_berkala') == 'semua' ? 'selected' : '') : '' }}>Semua</option>
                                                    <option value="hampir_berakhir" {{ app('request')->input('tmt_berkala') ? (app('request')->input('tmt_berkala') == 'hampir_berakhir' ? 'selected' : '') : '' }}>Hampir Berakhir</option>
                                                    <option value="telah_berakhir" {{ app('request')->input('tmt_berkala') ? (app('request')->input('tmt_berkala') == 'telah_berakhir' ? 'selected' : '') : '' }}>Telah Berakhir</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-social bg-blue"><i class="fa fa-filter"></i> Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                            <div class="table-responsive">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NAMA</th>
                                            <th>NIP</th>
                                            <th>GOL. RUANG</th>
                                            <th>SK TERAKHIR</th>
                                            <th>TMT</th>
                                            <th>JABATAN SEKARANG</th>
                                            <th>TMT BERKALA AKAN DATANG</th>
                                            <th>UNIT KERJA</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pegawai as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nip }}</td>
                                            <td>{{ $item->gol_ruang->gol_ruang }}</td>
                                            <td>{{ $item->sk_terakhir }}</td>
                                            <td>{{ $item->tmt }}</td>
                                            <td>{{ $item->jabatan->jabatan }}</td>
                                            <td>
                                                @php
                                                $masaTmt = masaBerakhirTMT($item->tmt_berkala_akan_datang);
                                                @endphp
                                                <span class="badge bg-{{ $masaTmt <= 0 ? 'red' : ($masaTmt <= 100 && $masaTmt > 0 ? 'yellow' : 'green') }}">
                                                    {{ $item->tmt_berkala_akan_datang }}
                                                </span>
                                            </td>
                                            <td>{{ $item->unit_kerja->unit_kerja }}</td>
                                            <td>
                                                <a href="{{ route('pegawai.edit', $item->id) }}" class="btn bg-yellow btn-flat btn-sm">
                                                    <i class="fa fa-edit"></i> 
                                                </a>
                                                <form action="{{ route('pegawai.destroy', $item->id) }}" style="display: inline-block" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="id">
                                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus pegawai?')" class="btn bg-red btn-flat btn-sm">
                                                        <i class="fa fa-trash"></i> 
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>NAMA</th>
                                                <th>NIP</th>
                                                <th>GOL. RUANG</th>
                                                <th>SK TERAKHIR</th>
                                                <th>TMT</th>
                                                <th>JABATAN SEKARANG</th>
                                                <th>TMT BERKALA AKAN DATANG</th>
                                                <th>UNIT KERJA</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        @endsection
        
        @section('script')
        <!-- DataTables -->
        <script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
                $('#table').DataTable()
            })
        </script>

        @endsection