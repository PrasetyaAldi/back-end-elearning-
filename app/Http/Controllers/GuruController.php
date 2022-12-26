<?php

namespace App\Http\Controllers;

use App\Services\GuruService;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * get data guru from school
     * 
     * @param \App\Services\GuruService $guruService
     * @param string $kodesekolah
     * @return \Illuminate\Http\Response
     */
    public function getGuruSekolah(GuruService $guruService, $kodesekolah)
    {
        return $guruService->getGuru($kodesekolah);
    }
}
