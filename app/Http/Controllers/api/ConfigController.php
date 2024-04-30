<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseApi;
use App\Models\Jenispasar;
use App\Models\Komoditas;
use App\Models\Kota;
use App\Models\Subkomoditas;

class ConfigController extends Controller
{

    public function Config()
    {
        $datakomoditas = Komoditas::get();
        $datajenispasar = Jenispasar::get();
        $datasubkomoditas = Subkomoditas::get();
        $datakota = Kota::get();

        $data = [
            "komoditas" => $datakomoditas,
            "subkomoditas" => $datasubkomoditas,
            "kota" => $datakota,
            "jenispasar" => $datajenispasar,
        ];


        return ResponseApi::success($data);
    }

    public function Configsubid($id)
    {
        $data = Subkomoditas::where('komoditas_id', $id)->get();

        return ResponseApi::success($data);
    }
}
