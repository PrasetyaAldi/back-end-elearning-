<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangbelajar extends Model
{
    protected $table = 'ruangbelajar';
    protected $primaryKey = 'idrb';
    protected $guarded = ['idrb'];

    public function matapelajaran()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'idguru', 'idguru');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'idperiode', 'idperiode');
    }

    public function bahanajar()
    {
        return $this->hasMany(Bahanajar::class, 'idrb', 'idrb');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idkelas', 'idkelas');
    }

    public function pesertabelajar()
    {
        return $this->belongsTo(Pesertabelajar::class, 'idkelas', 'idkelas', 'idperiode', 'idperiode');
    }
}
