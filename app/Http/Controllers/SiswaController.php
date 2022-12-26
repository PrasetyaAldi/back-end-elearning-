<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * store new siswa
     * 
     * @param App\Http\Requests\SiswaRequest $request
     * @param \App\Services\SiswaService $siswaService
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaRequest $request, SiswaService $siswaService)
    {
        return $siswaService->store($request);
    }

    /**
     * show list siswa from sekolah
     */
    public function getSiswaSekolah(SiswaService $siswaService, $npsn)
    {
        return $siswaService->getSiswaSekolah($npsn);
    }

    /**
     * update siswa
     */
    public function update(SiswaRequest $request, SiswaService $siswaService, $nisn)
    {
        return $siswaService->update($request, $nisn);
    }

    /**
     * delete siswa
     */
    public function destroy(SiswaService $siswaService, $nisn)
    {
        return $siswaService->destroy($nisn);
    }
}
