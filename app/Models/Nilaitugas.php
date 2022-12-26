<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilaitugas extends Model
{

    protected $primaryKey = 'idnilai';
    protected $fillable = [
        'nisn',
        'idbahanajar',
        'jawaban',
        'namafile',
        'file',
        'nangka',
        'nhuruf'
    ];
    //
    protected $table = 'nilaitugas';

    public function bahanajar()
    {
        return $this->belongsTo(Bahanajar::class, 'idbahanajar');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn');
    }
}
