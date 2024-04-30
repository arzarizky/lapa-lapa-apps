<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\api\NotifikasiController;
use App\Http\Controllers\Controller;
use App\Models\Jenispasar;
use App\Models\Komoditas;
use App\Models\Notifikasi;
use App\Models\Pemilik;
use App\Models\Rekapharga;
use App\Models\Subkomoditas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;

class DatakomoditasController extends Controller
{
    public function index()
    {
        $kota = auth()->user()->kota->id;

        $data_komoditas = Pemilik::with(['komoditas', 'jenispasar', 'subkomoditas'])->where('kota_id', $kota)->distinct()->get(['komoditas_id']);
        // dd($data_komoditas);
        foreach ($data_komoditas as $key => $value) {
            $data_komoditas[$key]['total'] = Pemilik::with(['komoditas'])->where('kota_id', $kota)->where('komoditas_id', $value->komoditas_id)->get()->count();
            $data_komoditas[$key]['subkomoditassss'] = Pemilik::with(['subkomoditas'])->where('kota_id', $kota)->where('komoditas_id', $value->komoditas_id)->first();
        }

        // return response()->json($data_komoditas);
        return view('admin.data-komuditas.kategori-komuditas', compact(['data_komoditas']));
    }

    public function subkategori($nama)
    {
        $kota = auth()->user()->kota->id;
        $data_komoditas = Komoditas::where('nama', $nama)->first();
        // $data_pasar = Jenispasar::where('nama', $namapasar)->first();
        $data_subkomoditas = Pemilik::with(['subkomoditas'])->where('kota_id', $kota)->where('komoditas_id', $data_komoditas->id)->get();

        $data_komoditas = Komoditas::where('nama', $nama)->first();
        // $data_subkomoditas = Subkomoditas::where('komoditas_id', $data_komoditas->id)->get();
        return view('admin.data-komuditas.sub-kategori-komuditas', compact(['data_subkomoditas']));
    }

    public function detailsubkategori($nama, $namapasar, Request $request)
    {
        $kota = auth()->user()->kota->id;
        $subkomoditas = Subkomoditas::where('nama', $nama)->first();
        $data_pasar = Jenispasar::where('nama', $namapasar)->first();
        $nama = Pemilik::where('kota_id', $kota)->where('subkomoditas_id', $subkomoditas->id)->where('pasar_id', $data_pasar->id)->first();

        // $nama = Subkomoditas::where('nama', $nama)->first();
        // dd($kota);
        $rekapharga_subkomoditas = Rekapharga::with(['pemilik.komoditas', 'pemilik.subkomoditas', 'pemilik.jenispasar', 'user'])->where('pemilik_id', $nama->id)->orderBy('tanggal', 'DESC')->get();
        return view('admin.data-komuditas.informasi-komuditas', compact(['rekapharga_subkomoditas', 'nama']));
    }

    public function harga(Request $request)
    {
        $data = Rekapharga::with(['pemilik.kota', 'pemilik.subkomoditas'])->where('pemilik_id', $request->input('pemilik_id'))->first();
        $hargabaru = preg_replace("/[^0-9]/", "", $request->input('harga'));
        if ($data->harga < $hargabaru) {
            $title = "Kenaikan Harga";
            $condition = "UP";
            NotifikasiController::pushnotif($title, 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'));
            Notifikasi::create([
                'time' => Carbon::now(),
                'title' => $title,
                'description' => 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'),
                'condition' => $condition,
            ]);
        } elseif ($data->harga > $hargabaru) {
            $title = "Penurunan Harga";
            $condition = "DOWN";
            NotifikasiController::pushnotif($title, 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'));
            Notifikasi::create([
                'time' => Carbon::now(),
                'title' => $title,
                'description' => 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'),
                'condition' => $condition,
            ]);
        }
        for ($i = 0; $i < 7; $i++) {
            Rekapharga::create(['pemilik_id' => $request->input('pemilik_id'), 'harga' => preg_replace("/[^0-9]/", "", $request->input('harga')), 'dk' => $request->input('dk'), 'dp' => $request->input('dp'), 'tanggal' => Carbon::now()->addDay($i)]);
        }
        return redirect()->back()->with('success', 'Berhasil tambah list harga');
    }
    public function updateharga(Request $request)
    {
        $data = Rekapharga::with(['pemilik.kota', 'pemilik.subkomoditas'])->where('id', $request->input('id'))->first();
        // return response($data);
        $hargabaru = preg_replace("/[^0-9]/", "", $request->input('harga'));
        if ($data->harga < $hargabaru) {
            $title = "Kenaikan Harga";
            $condition = "UP";
            NotifikasiController::pushnotif($title, 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'));
            Notifikasi::create([
                'time' => Carbon::now(),
                'title' => $title,
                'description' => 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'),
                'condition' => $condition,
            ]);
        } elseif ($data->harga > $hargabaru) {
            $title = "Penurunan Harga";
            $condition = "DOWN";
            NotifikasiController::pushnotif($title, 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'));
            Notifikasi::create([
                'time' => Carbon::now(),
                'title' => $title,
                'description' => 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'),
                'condition' => $condition,
            ]);
        }


        Rekapharga::with(['pemilik.kota', 'pemilik.subkomoditas'])->where('id', $request->input('id'))->update(['harga' => preg_replace("/[^0-9]/", "", $request->input('harga')), 'dk' => $request->input('dk'), 'dp' => $request->input('dp'), 'useredit_id' => auth()->user()->id]);
        return redirect()->back()->with('success', 'Berhasil tambah list harga');
    }

    public function hargatanggal(Request $request)
    {
        $data = Rekapharga::with(['pemilik.kota', 'pemilik.subkomoditas'])->where('pemilik_id', $request->input('pemilik_id'))->first();
        $hargabaru = preg_replace("/[^0-9]/", "", $request->input('harga'));
        if($data){
        if ($data->harga < $hargabaru) {
            $title = "Kenaikan Harga";
            $condition = "UP";
            NotifikasiController::pushnotif($title, 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'));
            Notifikasi::create([
                'time' => Carbon::now(),
                'title' => $title,
                'description' => 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'),
                'condition' => $condition,
            ]);
        } elseif ($data->harga > $hargabaru) {
            $title = "Penurunan Harga";
            $condition = "DOWN";
            NotifikasiController::pushnotif($title, 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'));
            Notifikasi::create([
                'time' => Carbon::now(),
                'title' => $title,
                'description' => 'Update Harga ' . $data->pemilik->subkomoditas->nama . ' di ' . $data->pemilik->kota->nama . ' menjadi ' . $request->input('harga'),
                'condition' => $condition,
            ]);
        }
        }
        Rekapharga::create(['pemilik_id' => $request->input('pemilik_id'), 'harga' => preg_replace("/[^0-9]/", "", $request->input('harga')), 'dk' => $request->input('dk'), 'dp' => $request->input('dp'), 'tanggal' => $request->input('tanggal')]);
        return redirect()->back()->with('success', 'Berhasil tambah list harga');
    }

    public function deleterekaphargaid($id)
    {
        Rekapharga::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Delete Data!!');
    }
}
