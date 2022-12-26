<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matapelajaran extends Model
{
    //
    protected $table = 'matapelajaran';
    protected $primaryKey = 'idmp';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'idmp',
        'npsn',
        'namamp',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function ruangbelajar()
    {
        return $this->hasMany(Ruangbelajar::class);
    }
}
