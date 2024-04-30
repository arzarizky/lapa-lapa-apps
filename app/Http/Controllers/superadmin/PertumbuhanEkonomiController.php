<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\PertumbuhanEkonomi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PertumbuhanEkonomiController extends Controller
{
    public function index()
    {
        $data = PertumbuhanEkonomi::get();

        return view('admin.data-pertumbuhan-ekonomi.index', compact(['data']));
    }
    public function delete($id)
    {
        PertumbuhanEkonomi::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil delete data');
    }
    public function create(Request $request)
    {
        PertumbuhanEkonomi::create([
            'tanggal' => Carbon::now(),
            'prosentase' => $request->input('pertumbuhan'),
            'useradd_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Berhasil Tambah data');
    }
}
