<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodeRequest;
use App\Models\Periode;
use App\Models\Sekolah;
use App\Services\PeriodeService;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PeriodeRequest $request, PeriodeService $periodeService)
    {
        return $periodeService->createPeriode($request);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPeriode($kodesekolah = null, PeriodeService $periodeService)
    {
        return $periodeService->getPeriode($kodesekolah);
    }

    /**
     * UPdate the specified resource in storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeriodeRequest $request, PeriodeService $periodeService, $idperiode)
    {
        return $periodeService->updatePeriode($request, $idperiode);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     */
    public function destroy(PeriodeService $periodeService, $idperiode)
    {
        return $periodeService->deletePeriode($idperiode);
    }
}
