<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
{
    public function index()
    {
        $data['jabatan'] = Jabatan::all();
        return view('admin.jabatan.index',$data);
    }

    public function create()
    {
        return view('admin.jabatan.form');
    }

    public function edit($id)
    {
        $data['data'] = Jabatan::findOrFail($id);
        return view('admin.jabatan.form',$data);
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
            'jabatan' => 'required'
        ]);

        $unitKerja = new Jabatan;
        $unitKerja->jabatan = $request->jabatan;
        if($unitKerja->save())
        {
            return redirect()->route('jabatan')->with(AlertFormatter::success("Jabatan berhasil di tambahkan."));
        }
        return redirect()->route('jabatan.create')->with(AlertFormatter::danger("Jabatan gagal di tambahkan."));
    }
    private function update(Request $request)
    {
        $request->validate([
            'jabatan' => 'required'
        ]);

        $unitKerja = Jabatan::findOrFail($request->id);
        $unitKerja->jabatan = $request->jabatan;
        if($unitKerja->save())
        {
            return redirect()->route('jabatan')->with(AlertFormatter::success("Jabatan berhasil di ubah."));
        }
        return redirect()->route('jabatan.edit', $request->id)->with(AlertFormatter::danger("Jabatan gagal di ubah."));
    }

    public function destroy($id)
    {
        if(Jabatan::destroy($id))
        {
            return redirect()->route('jabatan')->with(AlertFormatter::success("Jabatan berhasil di hapus."));
        }
        return redirect()->route('jabatan')->with(AlertFormatter::danger("Jabatan gagal di hapus."));
    }
}
