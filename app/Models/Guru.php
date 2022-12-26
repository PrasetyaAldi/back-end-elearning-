<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    //
    protected $table = 'guru';
    protected $primaryKey = 'idguru';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'idguru', 'npsn', 'nama', 'alamat', 'nip'
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'npsn', 'npsn');
    }

    public function ruangbelajar()
    {
        return $this->hasMany(Ruangbelajar::class, 'idguru');
    }
}
