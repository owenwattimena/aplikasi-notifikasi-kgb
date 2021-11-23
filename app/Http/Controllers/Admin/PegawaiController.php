<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Unitkerja;
use App\Models\Golruang;


class PegawaiController extends Controller
{
    public function index()
    {
        $data['pegawai'] = Pegawai::all();
        return view('admin.pegawai.index', $data);
    }

    public function create()
    {
        $data['jabatan'] = Jabatan::all();
        $data['unit_kerja'] = Unitkerja::all();
        $data['gol_ruang'] = Golruang::all();
        return view('admin.pegawai.form',$data);
    }
}
