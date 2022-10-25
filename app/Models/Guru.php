<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    //
    protected $table = 'guru';

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function ruangbelajar(){
        return $this->hasMany(Ruangbelajar::class);
    }

    // public function users(){
    //     return $this->hasOne(User::class);
    // }
}
