<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApi;
use App\Models\Kota;
use App\Models\Kritikdansaran;
use Illuminate\Http\Request;

class KritikdansaranController extends Controller
{
    public function postform(Request $request)
    {

        $data = Kritikdansaran::create([
            'kota_id' => $request->input('kota_id'),
            'nama' => $request->input('nama'),
            'kritik' => $request->input('kritik'),
            'saran' => $request->input('saran'),
            'status' => 'Belum Dibaca',
        ]);

        $kota = Kota::where('id', $request->input('kota_id'))->first();

        return ResponseApi::success($data, 'Berhasil menambahkan Saran dari ' . $data['nama'] . ' Ke kota ' . $kota->nama);
    }
}
