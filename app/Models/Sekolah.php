<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    //
    protected $table = 'sekolah';
    protected $primaryKey = 'npsn';
    protected $fillable = [
        'npsn', 'nama', 'alamat', 'kodesekolah'
    ];
    public $incrementing = false;
    protected $keyType = 'string';

    public function guru()
    {
        return $this->hasMany(Guru::class, 'npsn', 'npsn');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'npsn', 'npsn');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function matapelajaran()
    {
        return $this->hasMany(Matapelajaran::class);
    }

    public function periode()
    {
        return $this->hasMany(Periode::class);
    }
}
