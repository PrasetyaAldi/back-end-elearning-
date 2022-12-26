<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapelRequest;
use App\Services\MapelService;
use Illuminate\Http\Request;

class MapelController extends Controller
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
     * @param  \App\Http\Requests\MapelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MapelRequest $request, MapelService $mapelService)
    {
        return $mapelService->createMapel($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMapel($kodesekolah = null, MapelService $mapelService)
    {
        return $mapelService->getMapel($kodesekolah);
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
    public function update(MapelRequest $request, MapelService $mapelService, $idmapel)
    {
        return $mapelService->updateMapel($request, $idmapel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idmapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MapelService $mapelService, $idmapel)
    {
        return $mapelService->deleteMapel($idmapel);
    }
}
