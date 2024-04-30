<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Inflasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InflasiController extends Controller
{
    public function index()
    {
        $data = Inflasi::get();

        return view('admin.data-inflasi.index', compact(['data']));
    }

    public function delete($id)
    {
        Inflasi::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil delete data');
    }
    public function create(Request $request)
    {
        Inflasi::create([
            'tanggal' => Carbon::now(),
            'prosentase' => $request->input('inflasi'),
            'useradd_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Berhasil Tambah data');
    }
}
