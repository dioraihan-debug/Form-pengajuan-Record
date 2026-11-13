<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CctvRequest extends Model
{
    protected $fillable = [
        'nama_klien',
        'no_ktp',
        'no_hp',
        'alamat',
        'tanggal_kejadian',
        'waktu_kejadian',
        'posisi_cctv',
        'alasan_kronologi',
        'foto_ktp',
        'nomor_formulir',
        'tanggal_formulir',
        'status_keputusan',
        'status_pencarian',
        'file_pdf',
        'foto_dokumentasi',
    ];
    
    protected $casts = [
        'tanggal_kejadian' => 'date',
        'tanggal_formulir' => 'date',
    ];
}
