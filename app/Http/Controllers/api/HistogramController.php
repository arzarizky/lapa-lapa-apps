<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApi;
use App\Models\Pemilik;
use App\Models\Rekapharga;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistogramController extends Controller
{
    public function histogram(Request $request)
    {

        $data = Pemilik::with(['kota'])->where('subkomoditas_id', $request->input('subkomoditas_id'))->where('pasar_id', $request->input('pasar_id'))->get();
        // $data = $data->pluck('id');
        foreach ($data as $key => $value) {
            $data[$key]['rekapharga'] = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', $request->input('tanggal'))->first();
            $data[$key]['persentase'] = $this->persentase($request->input('opsi'), $value->id, $request->input('tanggal'), null);
        }
        // $data = Rekapharga::with(['pemilik.kota'])->whereIn('pemilik_id', $data)->where('tanggal', $request->input('tanggal'))->get();


        return ResponseApi::success($data);
    }

    public function persentase($opsi, $idpemilik, $tanggal, $statusklasifikasi)
    {
        $date = $tanggal;
        $datekemaren = Carbon::parse($tanggal)->addDay(-1);
        $dateminggukemaren = Carbon::parse($tanggal)->addWeek(-1);
        $datebulankemaren = Carbon::parse($tanggal)->addMonth(-1);
        $datetahunkemaren = Carbon::parse($tanggal)->addYear(-1);
        // dd($date->addDay(-1) . ' ' . $date);


        // $opsi = 'day';
        $nilaibaru = Rekapharga::where('pemilik_id', $idpemilik)->where('tanggal', $date)->first();
        // dd($nilaibaru);
        if (!$nilaibaru) {
            return ResponseApi::failed();
        }
        $nilaibaru = $nilaibaru->harga;
        if ($opsi == 'day') {
            $nilailama = Rekapharga::where('pemilik_id', $idpemilik)->where('tanggal', $datekemaren->toDateString())->first();
            if (!$nilailama) {
                return ResponseApi::failed("Tidak ada data harga kemaren");
            }
            $nilailama = $nilailama->harga;
        }
        if ($opsi == 'week') {
            $nilailama = Rekapharga::where('pemilik_id', $idpemilik)->where('tanggal', $dateminggukemaren->toDateString())->first();
            if (!$nilailama) {
                return ResponseApi::failed("Tidak ada data harga Minggu kemaren");
            }
            $nilailama = $nilailama->harga;
        }
        if ($opsi == 'month') {
            $nilailama = Rekapharga::where('pemilik_id', $idpemilik)->where('tanggal', $datebulankemaren->toDateString())->first();
            if (!$nilailama) {
                return ResponseApi::failed("Tidak ada data harga Bulan kemaren");
            }
            $nilailama = $nilailama->harga;
        }
        if ($opsi == 'year') {
            $nilailama = Rekapharga::where('pemilik_id', $idpemilik)->where('tanggal', $datetahunkemaren->toDateString())->first();
            if (!$nilailama) {
                return ResponseApi::failed("Tidak ada data harga Tahun kemaren");
            }
            $nilailama = $nilailama->harga;
        }
        if ($opsi == 'day') {
            $persentase = ($nilaibaru - $nilailama) / $nilailama * 100;
            $persentase = intval($persentase);
            if ($persentase < 0) {
                $persentase = ['warna' => 'down', 'value' => $persentase];
            } else {
                $persentase = ['warna' => 'up', 'value' => $persentase];
            }
            $datapersentase = [
                'opsi' => $opsi,
                'sekarang' => $date,
                'kemaren' => $datekemaren->toDateString('MDY'),
                'persentase' => $persentase,
                'klasifikasi' => $statusklasifikasi,
            ];
            return $datapersentase;
        }
        if ($opsi == 'week') {
            $persentase = ($nilaibaru - $nilailama) / $nilailama * 100;
            $persentase = intval($persentase);
            if ($persentase < 0) {
                $persentase = ['warna' => 'down', 'value' => $persentase];
            } else {
                $persentase = ['warna' => 'up', 'value' => $persentase];
            }
            $datapersentase = [
                'opsi' => $opsi,
                'sekarang' => $date,
                'Minggukemaren' => $dateminggukemaren->toDateString('MDY'),
                'persentase' => $persentase,
                'klasifikasi' => $statusklasifikasi,
            ];
            return $datapersentase;
        }
        if ($opsi == 'month') {
            $persentase = ($nilaibaru - $nilailama) / $nilailama * 100;
            $persentase = intval($persentase);
            if ($persentase < 0) {
                $persentase = ['warna' => 'down', 'value' => $persentase];
            } else {
                $persentase = ['warna' => 'up', 'value' => $persentase];
            }
            $datapersentase = [
                'opsi' => $opsi,
                'sekarang' => $date,
                'Bulankemaren' => $datebulankemaren->toDateString('MDY'),
                'persentase' => $persentase,
                'klasifikasi' => $statusklasifikasi,
            ];
            return $datapersentase;
        }
        if ($opsi == 'year') {
            $persentase = ($nilaibaru - $nilailama) / $nilailama * 100;
            $persentase = intval($persentase);
            if ($persentase < 0) {
                $persentase = ['warna' => 'down', 'value' => $persentase];
            } else {
                $persentase = ['warna' => 'up', 'value' => $persentase];
            }
            $datapersentase = [
                'opsi' => $opsi,
                'sekarang' => $date,
                'Tahunkemaren' => $datetahunkemaren->toDateString('MDY'),
                'persentase' => $persentase,
                'klasifikasi' => $statusklasifikasi,
            ];
            return $datapersentase;
        }
    }
}
