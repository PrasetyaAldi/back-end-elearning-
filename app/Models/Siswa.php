<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $table = 'siswa';

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function pesertabelajar(){
        return $this->belongsTo(Pesertabelajar::class);
    }
}
