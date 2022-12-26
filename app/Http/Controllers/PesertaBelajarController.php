<?php

namespace App\Http\Controllers;

use App\Http\Requests\PesertaBelajarRequest;
use App\Services\PesertaBelajarService;
use Illuminate\Http\Request;

class PesertaBelajarController extends Controller
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
     * @param  \App\Http\Requests\PesertaBelajarRequest  $request
     * @param \App\Services\PesertaBelajarService  $pesertaBelajarService
     * @return \Illuminate\Http\Response
     */
    public function store(PesertaBelajarRequest $request, PesertaBelajarService $service)
    {
        return $service->addPesertaBelajar($request);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Services\PesertaBelajarService  $pesertaBelajarService
     * @param  int  $idkelas
     * @return \Illuminate\Http\Response
     */
    public function PesertaBelajar(PesertaBelajarService $pesertaBelajarService, $idkelas, $idperiode)
    {
        return $pesertaBelajarService->getPesertaBelajar($idkelas, $idperiode);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Services\PesertaBelajarService  $pesertaBelajarService
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PesertaBelajarService $pesertaBelajarService, $idpb)
    {
        return $pesertaBelajarService->deletePesertaBelajar($idpb);
    }

    /**
     * get Peserta Belajar sekolah
     */
    public function PesertaBelajarSekolah(PesertaBelajarService $pesertaBelajarService, $kodesekolah)
    {
        return $pesertaBelajarService->getPesertaBelajarSekolah($kodesekolah);
    }
}
