<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    //
    protected $table = 'periode';
    protected $primaryKey = 'idperiode';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    public function ruangbelajar()
    {
        return $this->hasMany(Ruangbelajar::class, 'idperiode');
    }

    public function pesertabelajar()
    {
        return $this->hasMany(Pesertabelajar::class, 'idperiode');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'pesertabelajar', 'idperiode', 'nisn');
    }
}
