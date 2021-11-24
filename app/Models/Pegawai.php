<?php

namespace App\Models;

use App\Models\Jabatan;
use App\Models\Golruang;
use App\Models\UnitKerja;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    /**
     * Get the gol_ruang that owns the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gol_ruang()
    {
        return $this->belongsTo(Golruang::class, 'id_gol_ruang', 'id');
    }
    /**
     * Get the jabatan that owns the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id');
    }
    /**
     * Get the unit_kerja that owns the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit_kerja()
    {
        return $this->belongsTo(Unitkerja::class, 'id_unit_kerja', 'id');
    }
}
