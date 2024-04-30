<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jenispasar;
use App\Models\Komoditas;
use App\Models\Subkomoditas;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count_komoditas = Komoditas::get()->count();
        $count_subkomoditas = Subkomoditas::count();
        $count_admin = User::count();
        $count_pasar = Jenispasar::count();

        $data_komoditas = Komoditas::with(['jenispasar', 'subkomoditas.rekapharga', 'rekapharga'])->get();
        $data_pasar = Jenispasar::get();
        return view('admin.dashboard', compact(['count_komoditas', 'count_subkomoditas', 'count_admin', 'count_pasar', 'data_komoditas', 'data_pasar']));
    }
}
