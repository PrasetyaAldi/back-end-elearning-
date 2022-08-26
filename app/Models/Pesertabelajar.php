<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesertabelajar extends Model
{
    //
    protected $table = 'pesertabelajar';

    public function siswa(){
        return $this->hasMany(Siswa::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

}
