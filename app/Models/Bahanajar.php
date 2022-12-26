<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahanajar extends Model
{
    //
    protected $table = 'bahanajar';
    protected $primaryKey = 'idbahanajar';
    protected $guarded = ['idbahanajar'];

    public function ruangbelajar()
    {
        return $this->belongsTo(Ruangbelajar::class, 'idrb', 'idrb');
    }

    public function nilaitugas()
    {
        return $this->hasMany(Nilaitugas::class, 'idbahanajar', 'idbahanajar');
    }
}
