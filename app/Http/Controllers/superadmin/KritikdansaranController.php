<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Kritikdansaran;
use Illuminate\Http\Request;

class KritikdansaranController extends Controller
{
    public function index()
    {
        $kota = auth()->user()->kota->id;
        $data = Kritikdansaran::where('kota_id', $kota)->get();

        return view('admin.kritik-dan-saran.index', compact(['data']));
    }
    public function updatestatus(Request $request)
    {
        $id = $request->input('id');
        Kritikdansaran::where('id', $id)->update([
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'Berhasil update pesan ' . $request->input('status'));
    }
    public function deletepesan(Request $request, $id)
    {

        Kritikdansaran::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil hapus pesan ');
    }
}
