<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesertabelajar extends Model
{
    //
    protected $table = 'pesertabelajar';
    protected $primaryKey = 'idpb';
    protected $guarded = ['idpb'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'nisn', 'nisn');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idkelas', 'idkelas');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'idperiode', 'idperiode');
    }

    public function ruangbelajar()
    {
        return $this->hasMany(Ruangbelajar::class, 'idkelas', 'idkelas', 'idperiode', 'idperiode');
    }
}
