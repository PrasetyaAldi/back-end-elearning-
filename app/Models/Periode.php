<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    //
    protected $table = 'periode';

    public function ruangbelajar(){
        return $this->hasMany(Ruangbelajar::class);
    }

    public function pesertabelajar(){
        return $this->hasMany(Pesertabelajar::class);
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }
}
