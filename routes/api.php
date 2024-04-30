<?php

use App\Http\Controllers\api\ConfigController;
use App\Http\Controllers\api\HistogramController;
use App\Http\Controllers\api\InflasiController;
use App\Http\Controllers\api\KomoditasController;
use App\Http\Controllers\api\KritikdansaranController;
use App\Http\Controllers\api\NotifikasiController;
use App\Http\Controllers\api\PerdaganganController;
use App\Http\Controllers\api\PersentaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dev\DevController;
use App\Models\Komoditas;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('config', [ConfigController::class, 'config']);
Route::get('config/sub/{id}', [ConfigController::class, 'configsubid']);

Route::post('kritiksaran', [KritikdansaranController::class, 'postform']);

Route::prefix('homepage')->group(function () {
    Route::get('/index', [KomoditasController::class, 'index']);
    Route::post('/index', [KomoditasController::class, 'komoditasnew']);
    Route::get('/sub/{id}', [ConfigController::class, 'configsubid']);
    Route::get('/persentase/{opsi}', [PersentaseController::class, 'persentase']);
    Route::post('/histogram', [HistogramController::class, 'histogram']);
    Route::get('/in-pe', [InflasiController::class, 'index']);
});
Route::prefix('perdagangan')->group(function () {
    Route::post('/index', [PerdaganganController::class, 'index']);
    Route::post('/detail', [PerdaganganController::class, 'detail']);
    Route::get('/detailexport/{subkomoditas_id}/{kota_id}/{jenispasar_id}', [PerdaganganController::class, 'export']);
    Route::get('/export', [PerdaganganController::class, 'exports']);
});

Route::get('notifikasi', [NotifikasiController::class, 'index']);
Route::post('pushnotifikasi', [NotifikasiController::class, 'pushnotif']);

//api alacarte
Route::post('/ratarata', [PerdaganganController::class, 'margin']);
Route::post('/stdev', [PerdaganganController::class, 'stdev']);

//dev insert
Route::get('/full-data', [DevController::class, 'fullData']);
Route::get('/create-pemilik', [DevController::class, 'createPemilik']);
