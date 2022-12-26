<?php

namespace App\Http\Controllers;

use App\Http\Requests\BahanAjarRequest;
use App\Services\BahanAjarService;
use Illuminate\Http\Request;

class BahanAjarController extends Controller
{
    /**
     * store into database
     * 
     */
    public function store(BahanAjarRequest $request, BahanAjarService $service)
    {
        return $service->store($request);
    }

    /**
     * update into database
     * 
     */
    public function downloadMateri($idbahanajar, BahanAjarService $service)
    {
        return $service->downloadMateri($idbahanajar);
    }

    /**
     * Materi Guru
     */
    public function MateriGuru($idguru, BahanAjarService $service)
    {
        return $service->getMateriGuru($idguru);
    }

    /**
     * Materi Siswa
     */
    public function MateriSiswa($nisn, BahanAjarService $service)
    {
        return $service->getMateriTugasSiswa($nisn);
    }

    /**
     * Materi Siswa ruangbelajar
     */
    public function getMateriRuangBelajarSiswa($idrb, BahanAjarService $service)
    {
        return $service->getMateriRuangBelajarSiswa($idrb);
    }
}
