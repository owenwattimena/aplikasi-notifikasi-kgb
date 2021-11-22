<?php

namespace App\Http\Controllers\Admin;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;

class UnitKerjaController extends Controller
{
    function index()
    {
        $data['unit_kerja'] = UnitKerja::all();
        return view('admin.unit_kerja.index',$data);
    }

    public function create()
    {
        return view('admin.unit_kerja.form');
    }

    public function edit($id)
    {
        $data['data'] = UnitKerja::findOrFail($id);
        return view('admin.unit_kerja.form',$data);
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
        $request->validate([
            'unit_kerja' => 'required'
        ]);

        $unitKerja = new UnitKerja;
        $unitKerja->unit_kerja = $request->unit_kerja;
        if($unitKerja->save())
        {
            return redirect()->route('unit-kerja')->with(AlertFormatter::success("Unit kerja berhasil di tambahkan."));
        }
        return redirect()->route('unit-kerja.create')->with(AlertFormatter::danger("Unit kerja gagal di tambahkan."));
    }
    private function update(Request $request)
    {
        $request->validate([
            'unit_kerja' => 'required'
        ]);

        $unitKerja = UnitKerja::findOrFail($request->id);
        $unitKerja->unit_kerja = $request->unit_kerja;
        if($unitKerja->save())
        {
            return redirect()->route('unit-kerja')->with(AlertFormatter::success("Unit kerja berhasil di ubah."));
        }
        return redirect()->route('unit-kerja.edit', $request->id)->with(AlertFormatter::danger("Unit kerja gagal di ubah."));
    }

    public function destroy($id)
    {
        if(UnitKerja::destroy($id))
        {
            return redirect()->route('unit-kerja')->with(AlertFormatter::success("Unit kerja berhasil di hapus."));
        }
        return redirect()->route('unit-kerja')->with(AlertFormatter::danger("Unit kerja gagal di hapus."));
    }
}
