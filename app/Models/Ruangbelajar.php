<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangbelajar extends Model
{
    //
    protected $table = 'ruangbelajar';

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function matapelajaran(){
        return $this->belongsTo(Kelas::class);
    }

    public function guru(){
        return $this->belongsTo(Guru::class);
    }

    public function periode(){
        return $this->belongsTo(Periode::class);
    }

    public function bahanajar(){
        return $this->hasMany(Bahanajar::class);
    }
}
