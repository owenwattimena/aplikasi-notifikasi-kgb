<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Golruang;
use App\Helpers\AlertFormatter;


class GolruangController extends Controller
{
    public function index()
    {
        $data['gol_ruang'] = Golruang::all();
        return view('admin.gol-ruang.index', $data);
    }

    public function create()
    {
        return view('admin.gol-ruang.form');
    }

    public function edit($id)
    {
        $data['data'] = Golruang::findOrFail($id);
        return view('admin.gol-ruang.form',$data);
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
            'gol_ruang' => 'required'
        ]);

        $golRuang = new Golruang;
        $golRuang->gol_ruang = $request->gol_ruang;
        if($golRuang->save())
        {
            return redirect()->route('gol-ruang')->with(AlertFormatter::success("Gol. Ruang berhasil di tambahkan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Gol. Ruang gagal di tambahkan."));
    }
    private function update(Request $request)
    {
        $request->validate([
            'gol_ruang' => 'required'
        ]);

        $golRuang = Golruang::findOrFail($request->id);
        $golRuang->gol_ruang = $request->gol_ruang;
        if($golRuang->save())
        {
            return redirect()->route('gol-ruang')->with(AlertFormatter::success("Gol. Ruang berhasil di ubah."));
        }
        return redirect()->route('gol-ruang.edit', $request->id)->with(AlertFormatter::danger("Gol. Ruang gagal di ubah."));
    }

    public function destroy($id)
    {
        if(Golruang::destroy($id))
        {
            return redirect()->back()->with(AlertFormatter::success("Gol. Ruang berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Gol. Ruang gagal di hapus."));
    }
}
