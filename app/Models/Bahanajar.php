<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahanajar extends Model
{
    //
    protected $table = 'bahanajar';

    public function ruangbelajar(){
        return $this->belongsTo(Ruangbelajar::class);
    }

    public function nilaitugas(){
        return $this->hasMany(Nilaitugas::class);
    }
}
