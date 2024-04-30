<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Komoditas;
use App\Models\Subkomoditas;
use Illuminate\Http\Request;

class DatakomoditasController extends Controller
{
    public function index()
    {
        $data_komoditas = Komoditas::with(['subkomoditas'])->get();
        // dd($data_komoditas);
        return view('admin.data-komuditas.kategori-komuditas', compact(['data_komoditas']));
    }

    public function subkategori($nama)
    {
        $data_komoditas = Komoditas::where('nama', $nama)->first();
        $data_subkomoditas = Subkomoditas::where('komoditas_id', $data_komoditas->id)->get();
        return view('admin.data-komuditas.sub-kategori-komuditas', compact(['data_subkomoditas']));
    }
}
