<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Jenispasar;
use App\Models\Komoditas;
use App\Models\Kota;
use App\Models\Pemilik;
use App\Models\Rekapharga;
use App\Models\Subkomoditas;
use App\Models\User;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $kota = auth()->user()->kota->id;

        if ($request->has('subkomoditas')) {
            $filtersubkomoditas = $request->input('subkomoditas');
        } else {
            $filtersubkomoditas = "%";
        }
        if ($request->has('jenispasar')) {
            $filterjenispasar = $request->input('jenispasar');
        } else {
            $filterjenispasar = "%";
        }

        $count_komoditas = Pemilik::where('kota_id', $kota)->distinct()->count('komoditas_id');
        $count_subkomoditas = Pemilik::where('kota_id', $kota)->distinct()->count('subkomoditas_id');
        $filter = Pemilik::with(['subkomoditas', 'jenispasar', 'rekapharga'])->where('kota_id', $kota)->get();
        $data_komoditas = Pemilik::with(['subkomoditas', 'jenispasar', 'rekapharga'])->where('kota_id', $kota)
            ->where([
                ['pasar_id', 'like', $filterjenispasar],
                ['subkomoditas_id', 'like', $filtersubkomoditas],
            ])
            ->get();
        $count_admin = User::count();
        $count_pasar = Jenispasar::count();
        $data_pasar = Jenispasar::get();
        $datakota = Kota::get();


        // dd($data_komoditas);

        return view('admin.dashboard', compact(['filter', 'count_komoditas', 'count_subkomoditas', 'count_admin', 'count_pasar', 'data_komoditas', 'data_pasar', 'datakota']));
    }

    public function update_kota($id)
    {
        User::where('id', auth()->user()->id)->update(['kota_id' => $id]);
        return redirect()->route('superadmin.dashboard.index');
    }
}
