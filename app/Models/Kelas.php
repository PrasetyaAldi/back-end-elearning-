<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //
    protected $table = 'kelas';

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function pesertabelajar(){
        return $this->hasMany(Pesertabelajar::class);
    }

    public function ruangbelajar(){
        return $this->hasMany(Ruangbelajar::class);
    }

}
