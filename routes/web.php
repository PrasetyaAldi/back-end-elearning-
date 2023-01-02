<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/', function () use ($router) {
    return $router->app->version();
});
// login
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'RegisterController@register');
    $router->group(['middleware' => 'auth'], function () use ($router) {
        // get data user
        $router->get('/getdatauser', 'UserController@index');
        // get data for dashboard
        $router->get('/getdashboard/{npsn}', 'DashboardController@index');
        // kelas
        $router->post('/addkelas', 'KelasController@store');
        $router->get('/getkelas/{kodesekolah}', 'KelasController@getKelas');
        $router->put('/updatekelas/{idkelas}', 'KelasController@update');
        $router->delete('/deletekelas/{idkelas}', 'KelasController@destroy');
        //mapel
        $router->post('/addmapel', 'MapelController@store');
        $router->get('/getmapel/{kodesekolah}', 'MapelController@getMapel');
        $router->put('/updatemapel/{idmapel}', 'MapelController@update');
        $router->delete('/deletemapel/{idmapel}', 'MapelController@destroy');
        // periode
        $router->post('/addperiode', 'PeriodeController@store');
        $router->get('/getperiode/{kodesekolah}', 'PeriodeController@getPeriode');
        $router->put('/updateperiode/{idperiode}', 'PeriodeController@update');
        $router->delete('/deleteperiode/{idperiode}', 'PeriodeController@destroy');
        // siswa
        $router->get('/getsiswasekolah/{npsn}', 'SiswaController@getSiswaSekolah');
        $router->post('/addsiswa', 'SiswaController@store');
        $router->put('/updatesiswa/{nisn}', 'SiswaController@update');
        $router->delete('/deletesiswa/{nisn}', 'SiswaController@destroy');
        // peserta belajar
        $router->post('/addpesertabelajar', 'PesertaBelajarController@store');
        $router->get('/getpesertabelajarkelas/{idkelas}/{idperiode}', 'PesertaBelajarController@PesertaBelajar');
        $router->get('/getpesertabelajarsekolah/{kodesekolah}', 'PesertaBelajarController@PesertaBelajarSekolah');
        $router->delete('/deletepesertabelajar/{idpb}', 'PesertaBelajarController@destroy');
        // ruang belajar
        $router->post('/addruangbelajar', 'RuangBelajarController@store');
        $router->get('/getruangbelajar/{kodesekolah}', 'RuangBelajarController@RuangBelajar');
        $router->get('/getruangbelajarsiswa/{nisn}', 'RuangBelajarController@RuangBelajarSiswa');
        $router->get('/getruangbelajarguru/{idguru}', 'RuangBelajarController@RuangBelajarGuru');
        $router->get('/getbahanajarguru/{idrb}', 'RuangBelajarController@getBahanAjarGuru');
        $router->get('/getruangbelajaroption/{idguru}', 'RuangBelajarController@getRuangBelajarOption');
        $router->get('/getmemberruangbelajar/{idrb}', 'RuangBelajarController@getMemberRuangBelajar');
        $router->delete('/deleteruangbelajar/{idrb}', 'RuangBelajarController@destroy');
        // guru
        $router->get('/getgurusekolah/{kodesekolah}', 'GuruController@getGuruSekolah');
        // bahanajar
        $router->get('/downloadmateri/{idbahanajar}', 'BahanAjarController@downloadMateri');
        $router->post('/addmateriguru', 'BahanAjarController@store');
        $router->get('/getmateriguru/{idguru}', 'BahanAjarController@MateriGuru');
        $router->get('/getmaterisiswa/{nisn}', 'BahanAjarController@MateriSiswa');
        $router->get('/getbahanajarsiswarb/{idrb}', 'BahanAjarController@getMateriRuangBelajarSiswa');
        $router->put('/updatemateri/{idmateri}', 'BahanAjarController@update');
        $router->delete('/deletemateri/{idmateri}', 'BahanAjarController@destroy');
        $router->post('/siswaaddtugas', 'NilaiTugasController@store');
        // get nilai tugas
        $router->get('/gettugassiswaall/{idbahanajar}', 'NilaiTugasController@tugasSiswa');
        $router->get('/gettugasbahanajar/{idbahanajar}', 'NilaiTugasController@TugasGuru');
        $router->get('/getnilaisiswa/{idnilai}', 'NilaiTugasController@NilaiSiswa');
        $router->get('/downloadjawaban/{idnilai}', 'NilaiTugasController@downloadJawaban');
        // update nilai siswa
        $router->put('/updatenilaisiswa/{idnilai}', 'NilaiTugasController@updateNilai');

        // logout
        $router->get('/logout', 'AuthController@logout');
    });
});
// kelas
// periode
// peserta belajar
$router->put('/updatepesertabelajar/{idpesertabelajar}', 'PesertaBelajarController@update');
// ruang belajar
$router->put('/updateruangbelajar/{idruangbelajar}', 'RuangBelajarController@update');
// materi

// tugas and nilai
$router->put('/updatetugassiswa/{idnilai}', 'NilaiTugasController@updateTugas');
