<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $hidden = ['password'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'npsn', 'npsn');
    }

    public function pesertabelajar()
    {
        return $this->belongsTo(Pesertabelajar::class, 'nisn', 'nisn');
    }

    public function nilaitugas()
    {
        return $this->hasMany(Nilaitugas::class, 'nisn', 'nisn');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'pesertabelajar', 'nisn', 'idkelas');
    }

    public function periode()
    {
        return $this->belongsToMany(Periode::class, 'pesertabelajar', 'nisn', 'idperiode');
    }
}
