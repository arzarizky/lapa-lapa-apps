<?php

namespace App\Http\Controllers;

use App\Models\Inflasi;
use App\Models\Jenispasar;
use App\Models\Komoditas;
use App\Models\Kota;
use App\Models\Pemilik;
use App\Models\PertumbuhanEkonomi;
use App\Models\Rekapharga;
use App\Models\Subkomoditas;
use Carbon\Carbon;
use DateTime;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //session

        session::forget('subkomoditas');
        session::forget('pajenispasarsar');
        Session::forget('periode');
        Session::put('jenisinformasi', 'perbandingan_harga');
        //stddev
        $stddevdatapemilik = Pemilik::where([['subkomoditas_id', 2], ['pasar_id', 2]])->get()->pluck('id');
        $stddevdatarekapharga = Rekapharga::whereIn('pemilik_id', $stddevdatapemilik)->where('tanggal', Carbon::now()->format('Y-m-d'))->get()->pluck('harga');
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


        //rata-rata
        $datapemilik = Pemilik::where([['subkomoditas_id', 2], ['pasar_id', 2]])->get()->pluck('id');
        $datarekapharga = Rekapharga::whereIn('pemilik_id', $datapemilik)->where('tanggal', Carbon::now()->format('Y-m-d'))->get();
        $margin = 0;
        foreach ($datarekapharga as $key => $value) {
            $margin += $value->harga;
        }
        $ratarata = $margin ?? 0 / $datarekapharga->count() ?? 0;

        //klasifikasi margin
        $data1 = Pemilik::with(['komoditas', 'subkomoditas', 'jenispasar', 'kota'])->where([['subkomoditas_id', 2], ['pasar_id', 2]])->get()->pluck('id');
        $datarekapharga = Rekapharga::whereIn('pemilik_id', $data1)->where('tanggal', Carbon::now()->format('Y-m-d'))->get()->pluck('harga');
        // dd($datarekapharga);
        $hargatertinggi = $datarekapharga->max();
        $hargaterendah = $datarekapharga->min();
        $hargacount = $datarekapharga->count();
        if ($hargacount == 0) {
            $margin = 0;
            # code...
        } else {
            # code...
            $margin = intval(($hargatertinggi - $hargaterendah) / $hargacount);
        }
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

        $subkomoditas = Subkomoditas::get();
        $jenispasar = Jenispasar::get();
        $kota = Kota::get();
        $data['tanggalinput'] = Carbon::now()->format('Y-m-d');
        $data['tanggal'] = Carbon::now()->format('d M Y');
        $data['nama_subkomoditas'] = Subkomoditas::where('id', 2)->first();
        $data['tabelharga'] = Pemilik::with(['kota'])->where([
            ['subkomoditas_id', 2], ['pasar_id', 2]
        ])->get();

        foreach ($data['tabelharga'] as $key => $value) {
            $value['rekapharga'] = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::now()->format('Y-m-d'))->first();
            $hargakemaren = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::now()->addDay(-1)->format('Y-m-d'))->first();
            if (empty($value['rekapharga'])) {
                $harga1 = -1;
            } else {
                $harga1 = $value['rekapharga']->harga;
            }
            if ($hargakemaren) {
                if ($hargakemaren->harga > $harga1) {
                    // $value['selisih'] = $hargakemaren->harga . ' ' . $harga1;
                    $value['selisih'] = $harga1 - $hargakemaren->harga;
                }
                if ($hargakemaren->harga < $harga1) {
                    $value['selisih'] = $harga1 - $hargakemaren->harga;
                }
            } else {
                $value['selisih'] = 'No Data';
            }
            if ($harga1 >= $hargaterendah || $harga1 <= $hargaterendah) {
                $klasifikasistatus = '#1D8246';
            };
            if ($harga1 >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = '#23ae65';
            };
            if ($harga1 >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = '#8cb938';
            };
            if ($harga1 >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = '#c03a2b';
            };
            if ($harga1 >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = '#7c1d15';
            };
            if ($harga1 == -1) {
                $klasifikasistatus = '#a4a4a4';
            }
            $value['klasifikasi'] = $klasifikasistatus;
        }
        foreach ($data['tabelharga'] as $key => $value) {
            $harganow = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::now()->format('Y-m-d'))->first();
            $hargakemaren = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::now()->addDay(-1)->format('Y-m-d'))->first();
            if (empty($harganow) || empty($hargakemaren)) {
                $value['daytoday'] = 'No Data';
            } else {
                $value['daytoday'] = intval(($harganow->harga - $hargakemaren->harga) / $hargakemaren->harga * 100);
            }
            if ($harga1 >= $hargaterendah) {
                $klasifikasistatus = '#1D8246';
            };
            if ($harga1 >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = '#23ae65';
            };
            if ($harga1 >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = '#8cb938';
            };
            if ($harga1 >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = '#c03a2b';
            };
            if ($harga1 >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = '#7c1d15';
            };
            $value['daytodayklasifikasi'] = $klasifikasistatus;
        }
        foreach ($data['tabelharga'] as $key => $value) {
            $harganow = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::now()->format('Y-m-d'))->first();
            $hargakemaren = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::now()->addDay(-7)->format('Y-m-d'))->first();
            if (empty($harganow) || empty($hargakemaren)) {
                $value['weektoweek'] = 'No Data';
            } else {
                $value['weektoweek'] = intval(($harganow->harga - $hargakemaren->harga) / $hargakemaren->harga * 100);
            }
            if ($harga1 >= $hargaterendah) {
                $klasifikasistatus = '#1D8246';
            };
            if ($harga1 >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = '#23ae65';
            };
            if ($harga1 >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = '#8cb938';
            };
            if ($harga1 >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = '#c03a2b';
            };
            if ($harga1 >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = '#7c1d15';
            };
            $value['weektoweekklasifikasi'] = $klasifikasistatus;
        }
        foreach ($data['tabelharga'] as $key => $value) {
            $harganow = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::now()->format('Y-m-d'))->first();
            $hargakemaren = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::now()->addDay(-30)->format('Y-m-d'))->first();
            if (empty($harganow) || empty($hargakemaren)) {
                $value['monthtomonth'] = 'No Data';
            } else {
                $value['monthtomonth'] = intval(($harganow->harga - $hargakemaren->harga) / $hargakemaren->harga * 100);
            }
            if ($harga1 >= $hargaterendah) {
                $klasifikasistatus = '#1D8246';
            };
            if ($harga1 >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = '#23ae65';
            };
            if ($harga1 >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = '#8cb938';
            };
            if ($harga1 >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = '#c03a2b';
            };
            if ($harga1 >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = '#7c1d15';
            };
            $value['monthtomonthklasifikasi'] = $klasifikasistatus;
        }
        // dd($data);
        foreach ($data['tabelharga'] as $key => $value) {
            $value['rekapharga5'] = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', '<=', Carbon::now()->format('Y-m-d'))->orderBy('tanggal', 'DESC')->get()->take(5);
        }

        $datainflasicount = Inflasi::get()->count();
        $datapertumbuhancount = PertumbuhanEkonomi::get()->count();

        $datainflasi = Inflasi::get();
        $datapertumbuhan = PertumbuhanEkonomi::get();

        $data['inflasi'] = Inflasi::get()->last();
        if ($datainflasicount > 1) {
            // $nilaiinflasi = $datainflasi[$datainflasicount - 2]->prosentase - $datainflasi[$datainflasicount - 1]->prosentase;

            if ($datainflasi[$datainflasicount - 2]->prosentase > $datainflasi[$datainflasicount - 1]->prosentase) {
                $status2 = 'hasil-turun';
                $nilaiinflasi = $datainflasi[$datainflasicount - 2]->prosentase - $datainflasi[$datainflasicount - 1]->prosentase;
            }
            if ($datainflasi[$datainflasicount - 2]->prosentase < $datainflasi[$datainflasicount - 1]->prosentase) {
                $status2 = 'hasil-naik';
                $nilaiinflasi = $datainflasi[$datainflasicount - 1]->prosentase - $datainflasi[$datainflasicount - 2]->prosentase;
            }

            $data['inflasi']['inflasi_perubahan'] = ['status' => $status2, 'nilai' => $nilaiinflasi];
        }
        $data['pertumbuhan_ekonomi'] = PertumbuhanEkonomi::get()->last();
        if ($datapertumbuhancount > 1) {
            // $nilaipertumbuhan = $datapertumbuhan[$datapertumbuhancount - 2]->prosentase - $datapertumbuhan[$datapertumbuhancount - 1]->prosentase;

            if ($datapertumbuhan[$datapertumbuhancount - 2]->prosentase > $datapertumbuhan[$datapertumbuhancount - 1]->prosentase) {
                $status1 = 'hasil-turun';
                $nilaipertumbuhan = $datapertumbuhan[$datapertumbuhancount - 2]->prosentase - $datapertumbuhan[$datapertumbuhancount - 1]->prosentase;
            }
            if ($datapertumbuhan[$datapertumbuhancount - 2]->prosentase < $datapertumbuhan[$datapertumbuhancount - 1]->prosentase) {
                $status1 = 'hasil-naik';
                $nilaipertumbuhan = $datapertumbuhan[$datapertumbuhancount - 1]->prosentase - $datapertumbuhan[$datapertumbuhancount - 2]->prosentase;
            }

            $data['pertumbuhan_ekonomi']['pertumbuhan_ekonomi_perubahan'] = ['status' => $status1, 'nilai' => $nilaipertumbuhan];
        }




        //Semua pemilik
        $pemiliksemuakota_id = Pemilik::where([['subkomoditas_id', 2], ['pasar_id', 1]])->get()->pluck('id');
        $tanggalrekaphargasemuakota = Rekapharga::whereIn('pemilik_id', $pemiliksemuakota_id)->orderBy('tanggal', 'DESC')->select('tanggal')->distinct()->get()->pluck('tanggal')->take(5);
        // dd($tanggalrekaphargasemuakota);
        $arrsemuakota = [];
        $arrsemuakota['tabelharga'] = [];
        foreach ($tanggalrekaphargasemuakota as $key => $value) {
            $rekaphargasemuakota = Rekapharga::whereIn('pemilik_id', $pemiliksemuakota_id)->where([['tanggal', $value]])->get();
            $rekaphargasemuakotasum = 0;
            $countpembagi = 0;
            foreach ($rekaphargasemuakota as $keyrekaphargasemuakota => $valuerekaphargasemuakota) {
                $rekaphargasemuakotasum += $valuerekaphargasemuakota->harga;
                $countpembagi += 1;
            }
            array_push($arrsemuakota['tabelharga'], ['harga' => intval($rekaphargasemuakotasum / $countpembagi), 'tanggal' => $valuerekaphargasemuakota->tanggal,]);
        }


        $semuakota = $arrsemuakota;
        // $data['semuakota'] = [['tabelharga' => 'asu']];
        // return dd($data['tabelharga']);
        return view('welcome', compact(['stddev', 'ratarata', 'semuakota', 'data', 'subkomoditas', 'jenispasar', 'kota']));
    }


    public function indexpost(Request $request)
    {
        //session
        session::put('subkomoditas', $request->input('subkomoditas'));
        session::put('pajenispasarsar', $request->input('jenispasar'));
        Session::forget('periode');
        Session::forget('jenisinformasi');
        Session::put('jenisinformasi', $request->input('informasi_harga'));
        if ($request->input('informasi_harga') != 'perbandingan_harga') {
            Session::put('periode', $request->input('periode'));
        }

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

        //ratarata
        $datapemilik = Pemilik::where([['subkomoditas_id', $request->input('subkomoditas')], ['pasar_id', $request->input('jenispasar')]])->get()->pluck('id');
        $datarekapharga = Rekapharga::whereIn('pemilik_id', $datapemilik)->where('tanggal', $request->input('tanggal'))->get();
        $margin = 0;
        foreach ($datarekapharga as $key => $value) {
            $margin += $value->harga;
        }
        if ($datarekapharga->count() == 0) {
            return redirect()->back()->with('error', 'No data!!!');
        }
        $ratarata = $margin / $datarekapharga->count();

        //klasifikasi margin
        $data1 = Pemilik::with(['komoditas', 'subkomoditas', 'jenispasar', 'kota'])->where([['subkomoditas_id', $request->input('subkomoditas')], ['pasar_id', $request->input('jenispasar')]])->get()->pluck('id');
        $datarekapharga = Rekapharga::whereIn('pemilik_id', $data1)->where('tanggal', $request->input('tanggal'))->get()->pluck('harga');
        // dd($data1);
        $hargatertinggi = $datarekapharga->max();
        $hargaterendah = $datarekapharga->min();
        $hargacount = $datarekapharga->count();
        if ($hargacount == 0) {
            $margin = 0;
        } else {
            $margin = intval(($hargatertinggi - $hargaterendah) / $hargacount);
        }
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
        // dd($klasifikasi['klasifikasi5']);

        // dd($request->all());
        $subkomoditas = Subkomoditas::get();
        $jenispasar = Jenispasar::get();
        $kota = Kota::get();
        $reqpasarid = $request->input('jenispasar');
        $reqsubkomoditasid = $request->input('subkomoditas');

        $data['tanggal'] =  date('d M Y', strtotime($request->input('tanggal')));
        $data['tanggalinput'] = $request->input('tanggal');
        $data['nama_subkomoditas'] = Subkomoditas::where('id', $reqsubkomoditasid)->first();

        $data['tabelharga'] = Pemilik::with(['kota'])->where([
            ['subkomoditas_id', $reqsubkomoditasid], ['pasar_id', $reqpasarid]
        ])->get();

        foreach ($data['tabelharga'] as $key => $value) {
            $value['rekapharga'] = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', $request->input('tanggal'))->first();
            $hargakemaren = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::parse($request->input('tanggal'))->addDay(-1)->format('Y-m-d'))->first();
            if (!$value['rekapharga']) {
                $hargap1 = -1;
            } else {
                $hargap1 = $value['rekapharga']->harga;
            }
            if ($hargakemaren) {
                if ($hargakemaren->harga > $hargap1) {
                    // $value['selisih'] = $hargakemaren->harga . ' ' . $hargap1;
                    $value['selisih'] = $hargap1 - $hargakemaren->harga;
                }
                if ($hargakemaren->harga < $hargap1) {
                    $value['selisih'] = $hargap1 - $hargakemaren->harga;
                }
            } else {
                $value['selisih'] = 'No Data';
            }
            if ($hargap1 >= $hargaterendah || $hargap1 <= $hargaterendah) {
                $klasifikasistatus = '#1D8246';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = '#23ae65';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = '#8cb938';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = '#c03a2b';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = '#7c1d15';
            };
            if ($hargap1 == -1) {
                $klasifikasistatus = '#a4a4a4';
            }
            $value['klasifikasi'] = $klasifikasistatus;
        }
        foreach ($data['tabelharga'] as $key => $value) {
            $harganow = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', $request->input('tanggal'))->first();
            $hargakemaren = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::parse($request->input('tanggal'))->addDay(-1)->format('Y-m-d'))->first();
            if (empty($harganow) || empty($hargakemaren)) {
                $value['daytoday'] = 'No Data';
            } else {
                $value['daytoday'] = intval(($harganow->harga - $hargakemaren->harga) / $hargakemaren->harga * 100);
            }
            if ($hargap1 >= $hargaterendah) {
                $klasifikasistatus = '#1D8246';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = '#23ae65';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = '#8cb938';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = '#c03a2b';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = '#7c1d15';
            };
            $value['daytodayklasifikasi'] = $klasifikasistatus;
        }
        foreach ($data['tabelharga'] as $key => $value) {
            $harganow = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', $request->input('tanggal'))->first();
            $hargakemaren = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::parse($request->input('tanggal'))->addDay(-7)->format('Y-m-d'))->first();
            if (empty($harganow) || empty($hargakemaren)) {
                $value['weektoweek'] = 'No Data';
            } else {
                $value['weektoweek'] = intval(($harganow->harga - $hargakemaren->harga) / $hargakemaren->harga * 100);
            }
            if ($hargap1 >= $hargaterendah) {
                $klasifikasistatus = '#1D8246';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = '#23ae65';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = '#8cb938';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = '#c03a2b';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = '#7c1d15';
            };
            $value['weektoweekklasifikasi'] = $klasifikasistatus;
        }
        foreach ($data['tabelharga'] as $key => $value) {
            $harganow = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', $request->input('tanggal'))->first();
            $hargakemaren = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', Carbon::parse($request->input('tanggal'))->addDay(-30)->format('Y-m-d'))->first();
            if (empty($harganow) || empty($hargakemaren)) {
                $value['monthtomonth'] = 'No Data';
            } else {
                $value['monthtomonth'] = intval(($harganow->harga - $hargakemaren->harga) / $hargakemaren->harga * 100);
            }
            if ($hargap1 >= $hargaterendah) {
                $klasifikasistatus = '#1D8246';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi2']) {
                $klasifikasistatus = '#23ae65';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi3']) {
                $klasifikasistatus = '#8cb938';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi4']) {
                $klasifikasistatus = '#c03a2b';
            };
            if ($hargap1 >= $klasifikasi['klasifikasi5']) {
                $klasifikasistatus = '#7c1d15';
            };
            $value['monthtomonthklasifikasi'] = $klasifikasistatus;
        }
        foreach ($data['tabelharga'] as $key => $value) {
            $value['rekapharga5'] = Rekapharga::where('pemilik_id', $value->id)->where('tanggal', '<=', $request->input('tanggal'))->orderBy('tanggal', 'DESC')->get()->take(5);
        }

        $datainflasicount = Inflasi::get()->count();
        $datapertumbuhancount = PertumbuhanEkonomi::get()->count();

        $datainflasi = Inflasi::get();
        $datapertumbuhan = PertumbuhanEkonomi::get();

        $data['inflasi'] = Inflasi::get()->last();
        if ($datainflasicount > 1) {
            // $nilaiinflasi = $datainflasi[$datainflasicount - 2]->prosentase - $datainflasi[$datainflasicount - 1]->prosentase;

            if ($datainflasi[$datainflasicount - 2]->prosentase > $datainflasi[$datainflasicount - 1]->prosentase) {
                $status2 = 'hasil-turun';
                $nilaiinflasi = $datainflasi[$datainflasicount - 2]->prosentase - $datainflasi[$datainflasicount - 1]->prosentase;
            }
            if ($datainflasi[$datainflasicount - 2]->prosentase < $datainflasi[$datainflasicount - 1]->prosentase) {
                $status2 = 'hasil-naik';
                $nilaiinflasi = $datainflasi[$datainflasicount - 1]->prosentase - $datainflasi[$datainflasicount - 2]->prosentase;
            }

            $data['inflasi']['inflasi_perubahan'] = ['status' => $status2, 'nilai' => $nilaiinflasi];
        }
        $data['pertumbuhan_ekonomi'] = PertumbuhanEkonomi::get()->last();
        if ($datapertumbuhancount > 1) {
            // $nilaipertumbuhan = $datapertumbuhan[$datapertumbuhancount - 2]->prosentase - $datapertumbuhan[$datapertumbuhancount - 1]->prosentase;

            if ($datapertumbuhan[$datapertumbuhancount - 2]->prosentase > $datapertumbuhan[$datapertumbuhancount - 1]->prosentase) {
                $status1 = 'hasil-turun';
                $nilaipertumbuhan = $datapertumbuhan[$datapertumbuhancount - 2]->prosentase - $datapertumbuhan[$datapertumbuhancount - 1]->prosentase;
            }
            if ($datapertumbuhan[$datapertumbuhancount - 2]->prosentase < $datapertumbuhan[$datapertumbuhancount - 1]->prosentase) {
                $status1 = 'hasil-naik';
                $nilaipertumbuhan = $datapertumbuhan[$datapertumbuhancount - 1]->prosentase - $datapertumbuhan[$datapertumbuhancount - 2]->prosentase;
            }

            $data['pertumbuhan_ekonomi']['pertumbuhan_ekonomi_perubahan'] = ['status' => $status1, 'nilai' => $nilaipertumbuhan];
        }

        // dd($klasifikasi);

        return view('welcome', compact(['stddev', 'ratarata', 'data', 'subkomoditas', 'jenispasar', 'kota']));
    }

    public function indexpostbawah(Request $request)
    {
        $databawah = Pemilik::with(['subkomoditas', 'rekaphargaone'])->where([['kota_id', $request->input('kotabawah_id')], ['pasar_id', $request->input('jenispasarbawah_id')]])->get();

        // $databawah['rekapharga'] = [];
        foreach ($databawah as $key => $value) {
            $rekapharga = Rekapharga::where('pemilik_id', $value['id'])->orderBy('tanggal', 'DESC')->get()->take(7)->pluck('harga');
            $value['rekapharga'] = $rekapharga->reverse()->values();
            $value['selisihharga'] = $rekapharga[0] - $rekapharga[$rekapharga->count() - 1];
            $value['persentase'] = round(($rekapharga[0] - $rekapharga[$rekapharga->count() - 1]) / $rekapharga[$rekapharga->count() - 1] * 100, 2);
            if ($value['selisihharga'] > 0) {
                $status = "up";
                $color = "red";
            } elseif ($value['selisihharga'] < 0) {
                $status = "down";
                $color = "green";
                $value['selisihharga'] = $value['selisihharga'] * -1;
                $value['persentase'] = round((($rekapharga[0] - $rekapharga[$rekapharga->count() - 1]) / $rekapharga[$rekapharga->count() - 1] * 100) * -1, 2);
            } elseif ($value['selisihharga'] == 0) {
                $status = "flat";
                $color = "white";
            }

            $value['status'] = ['status' => $status, 'color' => $color];
        }
        // $databawah = $request->all();
        // $databawah = Kota::get();
        return response()->json($databawah);
    }

    public function semuakota(Request $request)
    {
        if ($request->input('kota_id')) {
        }
        //Semua pemilik
        $pemiliksemuakota_id = Pemilik::where([['subkomoditas_id', 2], ['pasar_id', 1]])->get()->pluck('id');
        $tanggalrekaphargasemuakota = Rekapharga::whereIn('pemilik_id', $pemiliksemuakota_id)->orderBy('tanggal', 'DESC')->select('tanggal')->distinct()->get()->pluck('tanggal')->take(5);
        // dd($tanggalrekaphargasemuakota);
        $arrsemuakota = [];
        $arrsemuakota['tabelharga'] = [];
        foreach ($tanggalrekaphargasemuakota as $key => $value) {
            $rekaphargasemuakota = Rekapharga::whereIn('pemilik_id', $pemiliksemuakota_id)->where([['tanggal', $value]])->get();
            $rekaphargasemuakotasum = 0;
            $countpembagi = 0;
            foreach ($rekaphargasemuakota as $keyrekaphargasemuakota => $valuerekaphargasemuakota) {
                $rekaphargasemuakotasum += $valuerekaphargasemuakota->harga;
                $countpembagi += 1;
            }
            array_push($arrsemuakota['tabelharga'], ['harga' => intval($rekaphargasemuakotasum / $countpembagi), 'tanggal' => $valuerekaphargasemuakota->tanggal]);
        }

        $arrsemuakota['tabelhargareverse'] = array_reverse($arrsemuakota['tabelharga']);

        $semuakota = $arrsemuakota;
        return response()->json($semuakota);
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


        return response()->json($ratarata);
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
}
