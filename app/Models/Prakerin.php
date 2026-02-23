<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prakerin extends Model
{
    protected $table = 'prakerin';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'no_pendataan',
        'nis',
        'nama_siswa',
        'id_sekolah',
        'id_jurusan',
        'tanggal_mulai_prakerin',
        'tanggal_akhir_prakerin',
    ];


    protected $casts = [
        'tanggal_mulai_prakerin' => 'date',
        'tanggal_akhir_prakerin' => 'date',
    ];

    // Relasi ke Sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }

    // Relasi ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
}
