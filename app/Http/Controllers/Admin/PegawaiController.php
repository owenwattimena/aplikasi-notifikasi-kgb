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
    public function index(Request $request)
    {
        $pegawai = Pegawai::all();
        $data['gol_ruang'] = Golruang::all();
        $data['jabatan'] = Jabatan::all();
        $data['unit_kerja'] = UnitKerja::all();
        $dataPegawai = $this->dataPegawai($pegawai, $request);
        $data['pegawai'] = $dataPegawai['pegawai'];
        $data['export_pdf_params'] = $dataPegawai['export_pdf_params'];
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

    public function export(Request $request)
    {
        $pegawai = Pegawai::all();
        $dataPegawai = $this->dataPegawai($pegawai, $request);
        $data['data_pegawai'] = $dataPegawai;
        $data['keadaan'] = strtoupper(date('F Y'));
        return view('admin.pegawai.export_pdf',$data);
    }

    private function dataPegawai($pegawai, Request $request)
    {
        $data = array();
        $pdf_export_params = '?';
        if ($request->has('gol_ruang') && !$request->isNotFilled('gol_ruang')) {
            $gol_ruang = $request->input('gol_ruang');
            $pdf_export_params .= 'gol_ruang='.$gol_ruang . '&';
            $pegawai = collect($pegawai)->filter(function($value,$key) use ($gol_ruang){
                return $value->id_gol_ruang == $gol_ruang;
            });
            $gol_ruang = Golruang::findOrFail($gol_ruang);
            $data['gol_ruang'] = $gol_ruang->gol_ruang;
        }
        
        if ($request->has('jabatan') && !$request->isNotFilled('jabatan')) {
            $jabatan = $request->input('jabatan');
            $pdf_export_params .= 'jabatan='.$jabatan . '&';
            $pegawai = collect($pegawai)->filter(function($value,$key) use ($jabatan){
                return $value->id_jabatan == $jabatan;
            });
            $jabatan = Jabatan::findOrFail($jabatan);
            $data['jabatan'] = $jabatan->jabatan;
        }
        
        if ($request->has('unit_kerja') && !$request->isNotFilled('unit_kerja')) {
            $unit_kerja = $request->input('unit_kerja');
            $pdf_export_params .= 'unit_kerja='.$unit_kerja . '&';
            $pegawai = collect($pegawai)->filter(function($value,$key) use ($unit_kerja){
                return $value->id_unit_kerja == $unit_kerja;
            });
            $unit_kerja = UnitKerja::findOrFail($unit_kerja);
            $data['unit_kerja'] = $unit_kerja->unit_kerja;
        }

        if($request->has('tmt_berkala') && !$request->isNotFilled('tmt_berkala')){
            $tmt_berkala = $request->input('tmt_berkala');
            $data['tmt_berkala'] = $tmt_berkala;
            $pdf_export_params .= 'tmt_berkala='.$tmt_berkala;
            if($tmt_berkala == 'hampir_berakhir')
            {
                $pegawai = collect($pegawai)->filter(function($value,$key){
                    $masaTmt = masaBerakhirTMT($value->tmt_berkala_akan_datang);
                    return $masaTmt <= 100 && $masaTmt > 0;
                });
            }
            else if($tmt_berkala == 'telah_berakhir'){
                $pegawai = collect($pegawai)->filter(function($value,$key){
                    $masaTmt = masaBerakhirTMT($value->tmt_berkala_akan_datang);
                    return $masaTmt <= 0;
                });
            }else{
                $pegawai = $pegawai;
            }
        }
        $data['pegawai'] = $pegawai;
        $data['export_pdf_params'] = $pdf_export_params;
        return $data;
    }
}
