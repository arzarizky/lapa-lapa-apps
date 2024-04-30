<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApi;
use App\Models\Komoditas;
use App\Models\Kota;
use App\Models\Pemilik;
use App\Models\Rekapharga;
use App\Models\Subkomoditas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;

class KomoditasController extends Controller
{

    public function index()
    {
        // $request->validate();
        $data = Pemilik::with(['komoditas', 'subkomoditas', 'jenispasar', 'rekapharga', 'kota'])->get();
        return ResponseApi::success($data);
    }
    public function komoditas(Request $request)
    {
        if (!$request->input('subkomoditas')) {
            return ResponseApi::failed('Require post body!!');
        }

        $data = Pemilik::with(['komoditas', 'subkomoditas', 'jenispasar', 'rekapharga', 'kota'])->where([['subkomoditas_id', $request->input('subkomoditas')], ['pasar_id', $request->input('pasar')], ['kota_id', $request->input('kota')]])->get();
        $rekapharga = 'ss';
        foreach ($data as $key => $value) {
            $data[$key]['tanggal'] = Carbon::now();
            $countrekap = $value->rekapharga->count();
            $value['sumharga'] = $value->rekapharga[$countrekap - 1]->harga;
            $idpemilik = $value->id;
            foreach ($value->rekapharga as $key1 => $valuesumharga) {
                $datas[$key1]['rekapharga'] = [
                    'subkomoditas' => $data[$key]->subkomoditas->nama,
                    'kota' => $data[$key]->kota,
                    'harga' => $value['sumharga'],
                    'tanggal' => Carbon::now(),
                    // 'pesentase' => $this->persentase(1000, 2000, $request->input('opsi'), $idpemilik)
                ];
            }
        }


        return ResponseApi::success($datas, 'Berhasil ambil data harian');
    }

    public function komoditasnew(Request $request)
    {
        if (!$request->input('subkomoditas')) {
            return ResponseApi::failed('Require post body!!');
        }

        if ($request->input('kota') == 0) {
            $data = Pemilik::with(['komoditas', 'subkomoditas', 'jenispasar', 'kota'])->where([['subkomoditas_id', $request->input('subkomoditas')], ['pasar_id', $request->input('pasar')]])->get();
            //klasifikasi margin
            $data1 = Pemilik::with(['komoditas', 'subkomoditas', 'jenispasar', 'kota'])->where([['subkomoditas_id', $request->input('subkomoditas')], ['pasar_id', $request->input('pasar')]])->get()->pluck('id');
            $datarekapharga = Rekapharga::whereIn('pemilik_id', $data1)->where('tanggal', $request->input('tanggal'))->get()->pluck('harga');
            $hargatertinggi = $datarekapharga->max();
            $hargaterendah = $datarekapharga->min();
            $hargacount = $datarekapharga->count();
            if (empty($hargacount)) {
                return ResponseApi::success(null);
            }
            $margin = intval(($hargatertinggi - $hargaterendah) / $hargacount);
            $klasifikasi1 = $hargaterendah + $margin;
            $klasifikasi2 = $klasifikasi1 + $margin;
            $klasifikasi3 = $klasifikasi2 + $margin;
            $klasifikasi4 = $klasifikasi3 + $margin;
            $klasifikasi5 = $klasifikasi4 + $margin;
            $klasifikasi = [];
            $klasifikasi['klasifikasi1'] = $klasifikasi1;
            $klasifikasi['klasifikasi2'] = $klasifikasi2;
            $klasifikasi['klasifikasi3'] = $klasifikasi3;
            $klasifikasi['klasifikasi4'] = $klasifikasi4;
            $klasifikasi['klasifikasi5'] = $klasifikasi5;

            $datas = [];
            foreach ($data as $key => $value) {
                $data = Rekapharga::with(['pemilik.subkomoditas'])->where([['pemilik_id', $value->id], ['tanggal', $request->input('tanggal')]])->first();
                if (empty($data)) {
                    $harga = 0;
                } else {
                    $harga = $data->harga;
                }
                if ($harga >= $hargaterendah) {
                    $klasifikasistatus = 'kurangpol';
                };
                if ($harga >= $klasifikasi['klasifikasi2']) {
                    $klasifikasistatus = 'kurang';
                };
                if ($harga >= $klasifikasi['klasifikasi3']) {
                    $klasifikasistatus = 'podoae';
                };
                if ($harga >= $klasifikasi['klasifikasi4']) {
                    $klasifikasistatus = 'naik';
                };
                if ($harga >= $klasifikasi['klasifikasi5']) {
                    $klasifikasistatus = 'naikpol';
                };
                $data['klasifikasi'] = $klasifikasistatus;
                $data['persentase'] = $this->persentase($request->input('opsi'), $value->id, $request->input('tanggal'), $klasifikasistatus);
                $data['pemilik']['kota'] = Pemilik::with(['kota'])->where('id', $value->id)->first();
                $data['pemilik']['kota'] = Kota::where('id', $data['pemilik']['kota']->kota_id)->first();
                array_push($datas, $data);
            }
            // if (Rekapharga::with(['pemilik.kota', 'pemilik.subkomoditas'])->where([['pemilik_id', $value->id], ['tanggal', $request->input('tanggal')]])->first() == null) {
            //     $datas = NULL;
            // }
            return ResponseApi::success($datas, 'Berhasil ambil data harian');
        }

        $data = Pemilik::with(['komoditas', 'subkomoditas', 'jenispasar', 'kota'])->where([['subkomoditas_id', $request->input('subkomoditas')], ['pasar_id', $request->input('pasar')], ['kota_id', $request->input('kota')]])->get();
        //klasifikasi margin
        $data1 = Pemilik::with(['komoditas', 'subkomoditas', 'jenispasar', 'kota'])->where([['subkomoditas_id', $request->input('subkomoditas')], ['pasar_id', $request->input('pasar')]])->get()->pluck('id');
        $datarekapharga = Rekapharga::whereIn('pemilik_id', $data1)->where('tanggal', $request->input('tanggal'))->get()->pluck('harga');
        $hargatertinggi = $datarekapharga->max();
        $hargaterendah = $datarekapharga->min();
        $hargacount = $datarekapharga->count();
        if (empty($hargacount)) {
            return ResponseApi::success(NULL);
        }
        $margin = intval(($hargatertinggi - $hargaterendah) / $hargacount);
        $klasifikasi1 = $hargaterendah + $margin;
        $klasifikasi2 = $klasifikasi1 + $margin;
        $klasifikasi3 = $klasifikasi2 + $margin;
        $klasifikasi4 = $klasifikasi3 + $margin;
        $klasifikasi5 = $klasifikasi4 + $margin;
        $klasifikasi = [];
        $klasifikasi['klasifikasi1'] = $klasifikasi1;
        $klasifikasi['klasifikasi2'] = $klasifikasi2;
        $klasifikasi['klasifikasi3'] = $klasifikasi3;
        $klasifikasi['klasifikasi4'] = $klasifikasi4;
        $klasifikasi['klasifikasi5'] = $klasifikasi5;
        foreach ($data as $key => $value) {
            $data = Rekapharga::with(['pemilik.kota', 'pemilik.subkomoditas'])->where([['pemilik_id', $value->id], ['tanggal', $request->input('tanggal')]])->first();
            $datas = [];
            if (empty($data)) {
                $harga = 0;
            } else {
                $harga = $data->harga;
            }
            if ($harga >= $hargaterendah || $harga <= $hargaterendah) {
                $klasifikasistatus = 'kurangpol';
            };
            if ($harga >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = 'kurang';
            };
            if ($harga >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = 'podoae';
            };
            if ($harga >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = 'naik';
            };
            if ($harga >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = 'naikpol';
            };
            $data['klasifikasi'] = $klasifikasistatus;
            $data['persentase'] = $this->persentase($request->input('opsi'), $value->id, $request->input('tanggal'), $klasifikasistatus);
            array_push($datas, $data);
            if (Rekapharga::with(['pemilik.kota', 'pemilik.subkomoditas'])->where([['pemilik_id', $value->id], ['tanggal', $request->input('tanggal')]])->first() == null) {
                $datas = NULL;
            }
            return ResponseApi::success($datas, 'Berhasil ambil data harian');
        }
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
