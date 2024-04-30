<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersentaseController extends Controller
{
    public function persentase(Request $request, $opsi)
    {
        $date = Carbon::now();
        $datekemaren = Carbon::now()->addDay(-1);
        $dateminggukemaren = Carbon::now()->addWeek(-1);
        $datebulankemaren = Carbon::now()->addMonth(-1);
        $datetahunkemaren = Carbon::now()->addYear(-1);
        // dd($date->addDay(-1) . ' ' . $date);
        $nilaibaru = 19000;
        $nilailama = 10000;

        if ($opsi == 'day') {
            $persentase = ($nilaibaru - $nilailama) / $nilailama * 100;
            if ($persentase < 0) {
                $persentase = ['warna' => 'down', 'value' => $persentase];
            } else {
                $persentase = ['warna' => 'up', 'value' => $persentase];
            }
            $data = [
                'opsi' => $opsi,
                'sekarang' => $date->toDateString('MDY'),
                'kemaren' => $datekemaren->toDateString('MDY'),
                'persentase' => $persentase,
            ];
            return ResponseApi::success($data);
        }
        if ($opsi == 'week') {
            $data = [
                'opsi' => $opsi,
                'sekarang' => $date->toDateString('MDY'),
                'Minggukemaren' => $dateminggukemaren->toDateString('MDY'),
                'persentase' => '',
            ];
            return ResponseApi::success($data);
        }
        if ($opsi == 'month') {
            $data = [
                'opsi' => $opsi,
                'sekarang' => $date->toDateString('MDY'),
                'Bulankemaren' => $datebulankemaren->toDateString('MDY'),
                'persentase' => '',
            ];
        }
        if ($opsi == 'year') {
            $data = [
                'opsi' => $opsi,
                'sekarang' => $date->toDateString('MDY'),
                'Tahunkemaren' => $datetahunkemaren->toDateString('MDY'),
                'persentase' => '',
            ];
            return ResponseApi::success($data);
        }
    }
}
