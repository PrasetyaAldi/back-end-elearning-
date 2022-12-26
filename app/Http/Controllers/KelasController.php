<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Services\KelasService;
use Exception;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KelasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $request, KelasService $kelasService)
    {
        return $kelasService->createKelas($request);
    }

    /**
     * Display the specified resource.
     *
     * @param mixed $kodesekolah
     * @return \Illuminate\Http\Response
     */
    public function getKelas($kodesekolah, KelasService $kelasService)
    {
        return $kelasService->getKelas($kodesekolah);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KelasRequest  $request
     * @param \App\Services\KelasService $kelasService
     * @param  string  $idkelas
     * @return \Illuminate\Http\Response
     */
    public function update(KelasRequest $request, KelasService $kelasService, $idkelas)
    {
        return $kelasService->updateKelas($request, $idkelas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Requests\KelasRequest  $request
     * @param  int  $idkelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(KelasService $kelasService, $idkelas)
    {
        return $kelasService->deleteKelas($idkelas);
    }
}
