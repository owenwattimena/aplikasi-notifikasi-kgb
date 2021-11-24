@extends('admin.templates.template')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
                            <div class="text-right" style="margin-bottom: 10px">
                                <a href="{{ route('pegawai.create') }}" class="btn btn-social bg-blue btn-flat">
                                    <i class="fa fa-plus"></i> TAMBAH
                                </a>
                            </div>
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
                                        <td>{{ $item->sk_terakhir }}</td>
                                        <td>{{ $item->gol_ruang->gol_ruang }}</td>
                                        <td>{{ $item->tmt }}</td>
                                        <td>{{ $item->jabatan->jabatan }}</td>
                                        <td>
                                            @php
                                                $masaTmt = masaBerakhirTMT($item->tmt_berkala_akan_datang);
                                            @endphp
                                            <span class="badge bg-{{ $masaTmt <= 0 ? 'red' : ($masaTmt <= 100 ? 'yellow' : 'green') }}">
                                                {{ $item->tmt_berkala_akan_datang }}
                                            </span>
                                        </td>
                                        <td>{{ $item->unit_kerja->unit_kerja }}</td>
                                        <td>
                                            <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-social bg-yellow btn-flat btn-sm">
                                                <i class="fa fa-edit"></i> UBAH
                                            </a>
                                            <form action="{{ route('jabatan.destroy', $item->id) }}" style="display: inline" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="id">
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus unit kerja?')" class="btn btn-social bg-red btn-flat btn-sm">
                                                    <i class="fa fa-trash"></i> HAPUS
                                                </button>
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
    <script>
        $(function () {
            $('#table').DataTable()
        })
    </script>
    @endsection