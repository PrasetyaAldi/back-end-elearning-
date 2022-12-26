<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuangBelajarRequest;
use App\Services\RuangBelajarService;
use Illuminate\Http\Request;

class RuangBelajarController extends Controller
{
    /**
     * Store data to database
     * 
     * @param \App\Http\Requests\RuangBelajarRequest $request
     * @param \App\Services\RuangBelajarService $service
     * @return \Illuminate\Http\Response
     */
    public function store(RuangBelajarRequest $request, RuangBelajarService $service)
    {
        return $service->createRuangBelajar($request);
    }

    /**
     * Update data to database
     * 
     * @param \App\Http\Requests\RuangBelajarRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RuangBelajarRequest $request, RuangBelajarService $service, $idruangbelajar)
    {
        return $service->updateRuangBelajar($request, $idruangbelajar);
    }

    /**
     * get ruangbelajar from sekolah
     * 
     * @param mixed $kodesekolah
     * @param \App\Services\RuangBelajarService $service
     * @return \Illuminate\Http\Response
     */
    public function RuangBelajar($kodesekolah, RuangBelajarService $service)
    {
        return $service->getRuangBelajar($kodesekolah);
    }

    /**
     * get ruangbelajar from siswa
     * 
     * @param mixed $nis
     */
    public function RuangBelajarSiswa($nisn, RuangBelajarService $service)
    {
        return $service->getRuangBelajarSiswa($nisn);
    }

    /**
     * get ruangbelajar from guru
     * 
     * @param mixed $idguru
     */
    public function RuangBelajarGuru($idguru, RuangBelajarService $service)
    {
        return $service->getRuangBelajarGuru($idguru);
    }

    /**
     * delete ruangbelajar
     */
    public function destroy($idrb, RuangBelajarService $service)
    {
        return $service->deleteRuangBelajar($idrb);
    }

    /**
     * get bahan ajar guru
     */
    public function getBahanAjarGuru(RuangBelajarService $service, $idrb)
    {
        return $service->getBahanAjarGuru($idrb);
    }

    /**
     * get ruang belajar for option
     */
    public function getRuangBelajarOption(RuangBelajarService $service, $idguru)
    {
        return $service->getRuangBelajarOption($idguru);
    }

    /**
     * get member ruang belajar
     */
    public function getMemberRuangBelajar(RuangBelajarService $service, $idrb)
    {
        return $service->getMemberRuangBelajar($idrb);
    }
}
