<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilaitugas extends Model
{
    //
    protected $table = 'nilaitugas';

    public function bahanajar(){
        return $this->belongsTo(Bahanajar::class);
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
}
