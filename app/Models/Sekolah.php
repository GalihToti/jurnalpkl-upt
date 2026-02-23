<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolah';
    protected $primaryKey = 'id_sekolah';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_sekolah'];

    public function prakerins()
    {
        return $this->hasMany(Prakerin::class, 'id_sekolah', 'id_sekolah');
    }
}
