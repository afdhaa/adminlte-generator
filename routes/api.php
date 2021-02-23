<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});





// Route::post('register', 'UserController@register');

Route::prefix('v1')->group(function () {
    Route::post('siswa', [App\Http\Controllers\API\CalonSiswaAPIController::class, 'store']);
    Route::get('infosiswa', [App\Http\Controllers\API\CalonSiswaAPIController::class, 'index'])->middleware('check_token');
    Route::resource('jalurs', JalurAPIController::class)->middleware('check_token');
    Route::resource('minats', MinatAPIController::class)->middleware('check_token');
    Route::resource('soal_tests', SoalTestAPIController::class)->middleware('check_token');;
    // Route::resource('siswa', CalonSiswaAPIController::class);

    Route::post('siswa/isidata', [App\Http\Controllers\API\CalonSiswaAPIController::class, 'isidata'])->middleware('check_token');
    Route::get('siswa/cekisidata', [App\Http\Controllers\API\CalonSiswaAPIController::class, 'cekisidata'])->middleware('check_token');

    Route::post('siswa/pilihjalur', [App\Http\Controllers\API\CalonSiswaAPIController::class, 'pilihJalur'])->middleware('check_token');
    Route::get('siswa/cekjalur', [App\Http\Controllers\API\CalonSiswaAPIController::class, 'cekpilihJalur'])->middleware('check_token');

    Route::post('siswa/pilihminat', [App\Http\Controllers\API\CalonSiswaAPIController::class, 'pilihMinat'])->middleware('check_token');
    Route::get('siswa/cekminat', [App\Http\Controllers\API\CalonSiswaAPIController::class, 'cekpilihMinat'])->middleware('check_token');
});


Route::resource('jalur_partisipasis', App\Http\Controllers\API\JalurPartisipasiAPIController::class);

Route::resource('calon_siswa_minats', App\Http\Controllers\API\CalonSiswaMinatAPIController::class);
