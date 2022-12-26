<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //
    protected $table = 'kelas';
    protected $primaryKey = 'idkelas';
    protected $fillable = [
        'idkelas',
        'npsn',
        'namakelas',
    ];
    public $incrementing = false;
    protected $keyType = 'string';

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function pesertabelajar()
    {
        return $this->hasMany(Pesertabelajar::class, 'idkelas');
    }

    public function ruangbelajar()
    {
        return $this->hasMany(Ruangbelajar::class, 'idkelas');
    }
}
