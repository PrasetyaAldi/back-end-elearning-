<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    //
    protected $table = 'sekolah';
    protected $primaryKey = 'npsn';
    protected $guarded = ['idsekolah'];

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
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

    // public function users(){
    //     return $this->belongsTo(User::class);
    // }
}
