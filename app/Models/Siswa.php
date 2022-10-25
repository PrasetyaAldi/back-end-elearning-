<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $table = 'siswa';
    protected $primaryKey = 'nisn';

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function pesertabelajar(){
        return $this->belongsTo(Pesertabelajar::class);
    }

    public function nilaitugas(){
        return $this->hasMany(Nilaitugas::class);
    }

    // public function users(){
    //     return $this->hasOne(User::class);
    // }
}
