<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matapelajaran extends Model
{
    //
    protected $table = 'matapelajaran';

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function ruangbelajar(){
        return $this->hasMany(Ruangbelajar::class);
    }
}
