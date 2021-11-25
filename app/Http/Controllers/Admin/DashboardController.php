<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        $tmtAkanBerakhir = collect($pegawai)->filter(function ($value, $key) {
            $masaTmt = masaBerakhirTMT($value->tmt_berkala_akan_datang);
            return $masaTmt <= 100 && $masaTmt > 0;
        });
        $tmtBerakhir = collect($pegawai)->filter(function ($value, $key) {
            $masaTmt = masaBerakhirTMT($value->tmt_berkala_akan_datang);
            return $masaTmt <= 0;
        });
        $data['total_pegawai'] = $pegawai->count();
        $data['tmt_akan_berakhir'] = $tmtAkanBerakhir->count();
        $data['tmt_berakhir'] = $tmtBerakhir->count();
        return view('admin.dashboard.index',$data);
    }
}
