<?php

namespace App\Http\Controllers;

use App\Http\Requests\NilaiTugasRequest;
use App\Models\Nilaitugas;
use App\Services\NilaiTugasService;
use Illuminate\Http\Request;

class NilaiTugasController extends Controller
{
    /**
     * siswa mengumpulkan tugas
     */
    public function store(NilaiTugasRequest $request, NilaiTugasService $service, Nilaitugas $nilaitugas)
    {
        return $service->store($request, $nilaitugas);
    }

    /**
     * menampilkan jawaban siswa
     */
    public function tugasSiswa(Nilaitugas $nilaitugas, NilaiTugasService $service, $idbahanajar)
    {
        return $service->tugasSiswa($idbahanajar);
    }

    /**
     * siswa update jawaban tugas
     */
    public function updateTugas(NilaiTugasRequest $request, NilaiTugasService $service, $idnilai)
    {
        $nilaitugas = Nilaitugas::find($idnilai);
        return $service->updateTugas($request, $nilaitugas);
    }

    /**
     * update nilai siswa
     */
    public function updateNilai(NilaiTugasRequest $request, NilaiTugasService $service, $idnilai)
    {
        $nilaitugas = Nilaitugas::find($idnilai);
        return $service->updateNilai($request, $nilaitugas);
    }

    /**
     * get nilai siswa
     */
    public function NilaiSiswa(NilaiTugasService $service, $idnilai)
    {
        return $service->NilaiSiswa($idnilai);
    }

    /**
     * download Jawaban
     */
    public function downloadJawaban(NilaiTugasService $service, $idnilai)
    {
        return $service->downloadJawaban($idnilai);
    }
}
