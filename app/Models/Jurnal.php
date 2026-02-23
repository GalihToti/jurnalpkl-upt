<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'jurnal';

    protected $fillable = [
        'no_jurnal',
        'waktu',
        'prakerin_id',
        'tanggal',
        'kegiatan',
        'tempat',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function prakerin()
    {
        return $this->belongsTo(Prakerin::class, 'prakerin_id');
    }
}
