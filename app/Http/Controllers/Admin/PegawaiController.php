<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Golruang;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;



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
        $data['unit_kerja'] = UnitKerja::all();
        $data['gol_ruang'] = Golruang::all();
        return view('admin.pegawai.form',$data);
    }
    public function edit($id)
    {
        $data['data'] = Pegawai::findOrFail($id);
        $data['jabatan'] = Jabatan::all();
        $data['unit_kerja'] = UnitKerja::all();
        $data['gol_ruang'] = Golruang::all();
        return view('admin.pegawai.form',$data);
    }

    public function save(Request $request)
    {
        if($request->id == 0)
        {
            return $this->store($request);
        }
        return $this->update($request);
    }

    private function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'nip' => 'required',
                'id_gol_ruang' => 'required',
                'sk_terakhir' => 'required',
                'tmt' => 'required',
                'id_jabatan' => 'required',
                'tmt_berkala_akan_datang' => 'required',
                'id_unit_kerja' => 'required',
            ]);

            $pegawai                            = new Pegawai;
            $pegawai->nama                      = $request->nama;
            $pegawai->nip                       = $request->nip;
            $pegawai->id_gol_ruang              = $request->id_gol_ruang;
            $pegawai->sk_terakhir               = $request->sk_terakhir;
            $pegawai->tmt                       = $request->tmt;
            $pegawai->id_jabatan                = $request->id_jabatan;
            $pegawai->tmt_berkala_akan_datang   = $request->tmt_berkala_akan_datang;
            $pegawai->id_unit_kerja             = $request->id_unit_kerja;

            if($pegawai->save())
            {
                return redirect()->route('pegawai')->with(AlertFormatter::success("Pegawai berhasil di tambahkan."));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pegawai gagal di tambahkan."))->withInput();
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return redirect()->back()->with(AlertFormatter::danger("Gagal menambahkan. Pegawai dengan NIP " . $request->nip . " telah terdaftar."))->withInput();
            }
        }
    }

    private function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'id_gol_ruang' => 'required',
            'sk_terakhir' => 'required',
            'tmt' => 'required',
            'id_jabatan' => 'required',
            'tmt_berkala_akan_datang' => 'required',
            'id_unit_kerja' => 'required',
        ]);

        $pegawai                            = Pegawai::findOrFail($request->id);
        $pegawai->nama                      = $request->nama;
        $pegawai->nip                       = $request->nip;
        $pegawai->id_gol_ruang              = $request->id_gol_ruang;
        $pegawai->sk_terakhir               = $request->sk_terakhir;
        $pegawai->tmt                       = $request->tmt;
        $pegawai->id_jabatan                = $request->id_jabatan;
        $pegawai->tmt_berkala_akan_datang   = $request->tmt_berkala_akan_datang;
        $pegawai->id_unit_kerja             = $request->id_unit_kerja;

        if($pegawai->save())
        {
            return redirect()->route('pegawai')->with(AlertFormatter::success("Pegawai berhasil di ubah."));
        }
        return redirect()->route('pegawai.edit', $request->id)->with(AlertFormatter::danger("Pegawai gagal di ubah."));
    }

    public function destroy($id)
    {
        if(Pegawai::destroy($id))
        {
            return redirect()->back()->with(AlertFormatter::success("Pegawai berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Pegawai gagal di hapus."));
    }
}
