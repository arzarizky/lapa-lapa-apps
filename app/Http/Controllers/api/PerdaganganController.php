<?php

namespace App\Http\Controllers\api;

use App\Exports\ApiDetailExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApi;
use App\Models\Kota;
use App\Models\Pemilik;
use App\Models\Rekapharga;
use App\Models\Subkomoditas;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PerdaganganController extends Controller
{
    public function index(Request $request)
    {
        $datapemilik = Pemilik::with(['subkomoditas'])->where('kota_id', $request->input('kota_id'))->where('pasar_id', $request->input('jenispasar_id'))->get();


        foreach ($datapemilik as $key => $value) {
            $datapemilik[$key]['rekapharga'] = Rekapharga::with([])->where('pemilik_id', $value->id)->get();
        }
        $datarekapharga = Rekapharga::with(['pemilik.subkomoditas'])->whereIn('pemilik_id', $datapemilik->pluck('id'))->get();
        $datasubkomoditas = Subkomoditas::get();
        foreach ($datasubkomoditas as $keydatasubkomoditas => $valuedatasubkomoditas) {
            $idpemilik = Pemilik::where('subkomoditas_id', $valuedatasubkomoditas->id)->where('kota_id', $request->input('kota_id'))->where('pasar_id', $request->input('jenispasar_id'))->get()->pluck('id');
            $valuedatasubkomoditas['rekapharga'] = Rekapharga::whereIn('pemilik_id', $idpemilik)->orderBy('tanggal', 'DESC')->get()->take(7);
            $countdatarekaparr = count($valuedatasubkomoditas['rekapharga']);
            $indicator = $valuedatasubkomoditas['rekapharga'][0]->harga - $valuedatasubkomoditas['rekapharga'][$countdatarekaparr - 1]->harga;
            $persentases = ($valuedatasubkomoditas['rekapharga'][0]->harga - $valuedatasubkomoditas['rekapharga'][$countdatarekaparr - 1]->harga) / $valuedatasubkomoditas['rekapharga'][$countdatarekaparr - 1]->harga * 100;

            if ($indicator < 0) {
                $valuedatasubkomoditas['indicator'] = ['status' => 'down', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
            if ($indicator == 0) {
                $valuedatasubkomoditas['indicator'] = ['status' => 'flat', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
            if ($indicator > 0) {
                $valuedatasubkomoditas['indicator'] = ['status' => 'up', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
        }

        return ResponseApi::success($datasubkomoditas);
    }


    public function indexold(Request $request)
    {
        $datapemilik = Pemilik::with(['subkomoditas'])->where('kota_id', $request->input('kota_id'))->where('pasar_id', $request->input('jenispasar_id'))->get();


        foreach ($datapemilik as $key => $value) {
            $datapemilik[$key]['rekapharga'] = Rekapharga::with([])->where('pemilik_id', $value->id)->get();
        }
        $datarekapharga = Rekapharga::with(['pemilik.subkomoditas'])->whereIn('pemilik_id', $datapemilik->pluck('id'))->get();
        $datasubkomoditas = Subkomoditas::get();
        foreach ($datasubkomoditas as $keydatasubkomoditas => $valuedatasubkomoditas) {
            $idpemilik = Pemilik::where('subkomoditas_id', $valuedatasubkomoditas->id)->where('kota_id', $request->input('kota_id'))->where('pasar_id', $request->input('jenispasar_id'))->get()->pluck('id');
            $valuedatasubkomoditas['rekapharga'] = Rekapharga::whereIn('pemilik_id', $idpemilik)->orderBy('tanggal', 'DESC')->get()->take(7);
            $countdatarekaparr = count($valuedatasubkomoditas['rekapharga']);
            $indicator = $valuedatasubkomoditas['rekapharga'][0]->harga - $valuedatasubkomoditas['rekapharga'][$countdatarekaparr - 1]->harga;
            $persentases = ($valuedatasubkomoditas['rekapharga'][0]->harga - $valuedatasubkomoditas['rekapharga'][$countdatarekaparr - 1]->harga) / $valuedatasubkomoditas['rekapharga'][$countdatarekaparr - 1]->harga * 100;

            if ($indicator < 0) {
                $valuedatasubkomoditas['indicator'] = ['status' => 'down', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
            if ($indicator == 0) {
                $valuedatasubkomoditas['indicator'] = ['status' => 'flat', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
            if ($indicator > 0) {
                $valuedatasubkomoditas['indicator'] = ['status' => 'up', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
        }

        return ResponseApi::success($datasubkomoditas);
    }




    public function detail(Request $request)
    {
        $data = Subkomoditas::where('id', $request->input('subkomoditas_id'))->first();

        if ($request->input('kota_id') == 0) {
            $data['pemilik'] = Pemilik::with('kota')->where('subkomoditas_id', $data->id)->where('pasar_id', $request->input('jenispasar_id'))->get();
        } else {
            $data['pemilik'] = Pemilik::with('kota')->where('subkomoditas_id', $data->id)->where('kota_id', $request->input('kota_id'))->where('pasar_id', $request->input('jenispasar_id'))->get();
        }

        $semuapemilikid = Pemilik::with('kota')->where('subkomoditas_id', $data->id)->where('pasar_id', $request->input('jenispasar_id'))->get()->pluck('id');
        $tanggalrekapharaga = Rekapharga::whereIn('pemilik_id', $semuapemilikid)->orderBy('tanggal', 'DESC')->first();
        $semuapemilik = Rekapharga::select(['tanggal'])->groupBy('tanggal')->whereIn('pemilik_id', $semuapemilikid)->orderBy('tanggal', 'DESC')->get()->take(5);
        // dd($semuapemilik);
        $tanggalsemuapemilik = $semuapemilik;
        $arraini = [];
        $arraini['rekapharga'] = [];
        $arraini['indicator'] = [];
        foreach ($tanggalsemuapemilik as $keytanggalsemuapemilik => $valuetanggalsemuapemilik) {
            $semuapemilikdaritanggal = Rekapharga::whereIn('pemilik_id', $semuapemilikid)->where('tanggal', $valuetanggalsemuapemilik->tanggal)->get();

            $jumlahsesuaitanggal = 0;
            foreach ($semuapemilikdaritanggal as $keysemuapemilikdaritanggal => $valuesemuapemilikdaritanggal) {
                $jumlahsesuaitanggal += $valuesemuapemilikdaritanggal->harga;
            }
            $jumlahsesuaitanggal = intval($jumlahsesuaitanggal / $semuapemilikdaritanggal->count());
            array_push($arraini['rekapharga'],  ['harga' => $jumlahsesuaitanggal, 'hari' => $valuesemuapemilikdaritanggal->tanggal]);
        }
        $semuakotaindicatorhitung = $arraini['rekapharga'][0]['harga'] - $arraini['rekapharga'][$keytanggalsemuapemilik - 1]['harga'];
        $persentasesemuakotaindicatorhitung = ($arraini['rekapharga'][0]['harga'] - $arraini['rekapharga'][$keytanggalsemuapemilik - 1]['harga']) / $arraini['rekapharga'][$keytanggalsemuapemilik - 1]['harga'] * 100;
        if ($semuakotaindicatorhitung < 0) {
            $persentasesemuakota = ['status' => 'down', 'harga' => $semuakotaindicatorhitung, 'persentase' => round($persentasesemuakotaindicatorhitung, 2)];
        }
        if ($semuakotaindicatorhitung == 0) {
            $persentasesemuakota = ['status' => 'flat', 'harga' => $semuakotaindicatorhitung, 'persentase' => round($persentasesemuakotaindicatorhitung, 2)];
        }
        if ($semuakotaindicatorhitung > 0) {
            $persentasesemuakota = ['status' => 'up', 'harga' => $semuakotaindicatorhitung, 'persentase' => round($persentasesemuakotaindicatorhitung, 2)];
        }
        $arraini['indicator'] = $persentasesemuakota;
        $data['semuakota'] = $arraini;
        // $data['semuapemilik'] = ['harga' => $jumlahsesuaitanggal, 'tanggal' => $valuesemuapemilikdaritanggal->tanggal, 'data' => $keysemuapemilikdaritanggal];


        foreach ($data['pemilik'] as $key => $value) {
            $data['pemilik'][$key]['rekapharga'] = Rekapharga::where('pemilik_id', $value->id)->orderBy('tanggal', 'DESC')->get()->take(7);
            $data['pemilik'][$key]['tabelharga'] = Rekapharga::where('pemilik_id', $value->id)->orderBy('tanggal', 'DESC')->get()->take(5);
            // $data['pemilik'][$key]['tabelhargasemua'] = $arraini;
            $countdatarekaparr = count($data['pemilik'][$key]['rekapharga']);
            $indicator = $data['pemilik'][$key]['rekapharga'][0]->harga - $data['pemilik'][$key]['rekapharga'][$countdatarekaparr - 1]->harga;
            $persentases = ($data['pemilik'][$key]['rekapharga'][0]->harga - $data['pemilik'][$key]['rekapharga'][$countdatarekaparr - 1]->harga) / $data['pemilik'][$key]['rekapharga'][$countdatarekaparr - 1]->harga * 100;
            if ($indicator < 0) {
                $data['pemilik'][$key]['indicator'] = ['status' => 'down', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
            if ($indicator == 0) {
                $data['pemilik'][$key]['indicator'] = ['status' => 'flat', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
            if ($indicator > 0) {
                $data['pemilik'][$key]['indicator'] = ['status' => 'up', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
        }
        // $data['rekapharga'] = Rekapharga::where('pemilik_id', $id)->orderBy('tanggal', 'DESC')->get()->take(5);
        // $data['reka']
        // $data = Carbon::now()->format('Y-m-d');
        return ResponseApi::success($data);
    }

    public function export($subkomoditas_id, $kota_id, $jenispasar_id)
    {
        $data = Subkomoditas::where('id', $subkomoditas_id)->first();

        if ($kota_id == 0) {
            $data['pemilik'] = Pemilik::with('kota')->where('subkomoditas_id', $data->id)->where('pasar_id', $jenispasar_id)->get();
        } else {
            $data['pemilik'] = Pemilik::with('kota')->where('subkomoditas_id', $data->id)->where('kota_id', $kota_id)->where('pasar_id', $jenispasar_id)->get();
        }

        $semuapemilikid = Pemilik::with('kota')->where('subkomoditas_id', $data->id)->where('pasar_id', $jenispasar_id)->get()->pluck('id');
        $tanggalrekapharaga = Rekapharga::whereIn('pemilik_id', $semuapemilikid)->orderBy('tanggal', 'DESC')->first();
        $semuapemilik = Rekapharga::select(['tanggal'])->groupBy('tanggal')->whereIn('pemilik_id', $semuapemilikid)->orderBy('tanggal', 'DESC')->get()->take(5);
        $tanggalsemuapemilik = $semuapemilik;
        $jumlahsesuaitanggal = 0;
        $arraini = [];
        $arraini['rekapharga'] = [];
        $arraini['indicator'] = [];
        foreach ($tanggalsemuapemilik as $keytanggalsemuapemilik => $valuetanggalsemuapemilik) {
            $semuapemilikdaritanggal = Rekapharga::whereIn('pemilik_id', $semuapemilikid)->where('tanggal', $valuetanggalsemuapemilik->tanggal)->get();

            foreach ($semuapemilikdaritanggal as $keysemuapemilikdaritanggal => $valuesemuapemilikdaritanggal) {
                $jumlahsesuaitanggal += $valuesemuapemilikdaritanggal->harga;
            }
            $jumlahsesuaitanggal = intval($jumlahsesuaitanggal / count($semuapemilikdaritanggal));
            array_push($arraini['rekapharga'],  ['harga' => $jumlahsesuaitanggal, 'hari' => $valuesemuapemilikdaritanggal->tanggal]);
        }
        $semuakotaindicatorhitung = $arraini['rekapharga'][0]['harga'] - $arraini['rekapharga'][$keytanggalsemuapemilik - 1]['harga'];
        $persentasesemuakotaindicatorhitung = ($arraini['rekapharga'][0]['harga'] - $arraini['rekapharga'][$keytanggalsemuapemilik - 1]['harga']) / $arraini['rekapharga'][$keytanggalsemuapemilik - 1]['harga'] * 100;
        if ($semuakotaindicatorhitung < 0) {
            $persentasesemuakota = ['status' => 'down', 'harga' => $semuakotaindicatorhitung, 'persentase' => round($persentasesemuakotaindicatorhitung, 2)];
        }
        if ($semuakotaindicatorhitung == 0) {
            $persentasesemuakota = ['status' => 'flat', 'harga' => $semuakotaindicatorhitung, 'persentase' => round($persentasesemuakotaindicatorhitung, 2)];
        }
        if ($semuakotaindicatorhitung > 0) {
            $persentasesemuakota = ['status' => 'up', 'harga' => $semuakotaindicatorhitung, 'persentase' => round($persentasesemuakotaindicatorhitung, 2)];
        }
        $arraini['indicator'] = $persentasesemuakota;
        $data['semuakota'] = $arraini;
        // $data['semuapemilik'] = ['harga' => $jumlahsesuaitanggal, 'tanggal' => $valuesemuapemilikdaritanggal->tanggal, 'data' => $keysemuapemilikdaritanggal];


        foreach ($data['pemilik'] as $key => $value) {
            $data['pemilik'][$key]['rekapharga'] = Rekapharga::where('pemilik_id', $value->id)->orderBy('tanggal', 'DESC')->get()->take(7);
            $data['pemilik'][$key]['tabelharga'] = Rekapharga::where('pemilik_id', $value->id)->orderBy('tanggal', 'DESC')->get()->take(5);
            // $data['pemilik'][$key]['tabelhargasemua'] = $arraini;
            $countdatarekaparr = count($data['pemilik'][$key]['rekapharga']);
            $indicator = $data['pemilik'][$key]['rekapharga'][0]->harga - $data['pemilik'][$key]['rekapharga'][$countdatarekaparr - 1]->harga;
            $persentases = ($data['pemilik'][$key]['rekapharga'][0]->harga - $data['pemilik'][$key]['rekapharga'][$countdatarekaparr - 1]->harga) / $data['pemilik'][$key]['rekapharga'][$countdatarekaparr - 1]->harga * 100;
            if ($indicator < 0) {
                $data['pemilik'][$key]['indicator'] = ['status' => 'down', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
            if ($indicator == 0) {
                $data['pemilik'][$key]['indicator'] = ['status' => 'flat', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
            if ($indicator > 0) {
                $data['pemilik'][$key]['indicator'] = ['status' => 'up', 'harga' => $indicator, 'persentase' => round($persentases, 2)];
            }
        }
        // return response([$data]);
        return Excel::download(new ApiDetailExport([$data]), 'detail.xlsx');
    }

    public function exports()
    {
        # code...
        // return Excel::download(new ApiDetailExport(), 'detail.xlsx');
    }

    public function stdev(Request $request)
    {
        //stddev
        $stddevdatapemilik = Pemilik::where([['subkomoditas_id', $request->input('subkomoditas')], ['pasar_id', $request->input('jenispasar')]])->get()->pluck('id');
        $stddevdatarekapharga = Rekapharga::whereIn('pemilik_id', $stddevdatapemilik)->where('tanggal', $request->input('tanggal'))->get()->pluck('harga');
        if (!empty($stddevdatarekapharga->count())) {
            $arrstddevdatarekapharga = [];
            foreach ($stddevdatarekapharga as $key => $value) {
                array_push($arrstddevdatarekapharga, $value);
            }
            $stddev = $this->Stand_Deviation($arrstddevdatarekapharga);
        } else {
            # code...
            $arrstddevdatarekapharga = [0, 0, 0, 0];
            $stddev = $this->Stand_Deviation($arrstddevdatarekapharga);
        }

        return ResponseApi::success($stddev);
    }

    public function Stand_Deviation($arr)
    {
        if (empty($arr)) {
            $num_of_elements = 0;
        } else {
            $num_of_elements = count($arr);
        }


        $variance = 0.0;

        // calculating mean using array_sum() method
        $average = array_sum($arr) / $num_of_elements;

        foreach ($arr as $i) {
            // sum of squares of differences between
            // all numbers and means.
            $variance += pow(($i - $average), 2);
        }

        return (int)sqrt($variance / $num_of_elements);
    }

    public function margin(Request $request)
    {
        $datapemilik = Pemilik::where([['subkomoditas_id', $request->input('subkomoditas_id')], ['pasar_id', $request->input('pasar_id')]])->get()->pluck('id');
        $datarekapharga = Rekapharga::whereIn('pemilik_id', $datapemilik)->where('tanggal', $request->input('tanggal'))->get();
        if (empty($datarekapharga->count())) {
            return ResponseApi::success(null);
        }
        $margin = 0;
        foreach ($datarekapharga as $key => $value) {
            $margin += $value->harga;
        }
        $ratarata = intval($margin / $datarekapharga->count());


        return ResponseApi::success($ratarata);
    }
}
