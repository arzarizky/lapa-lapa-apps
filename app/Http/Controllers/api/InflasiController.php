<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApi;
use App\Models\Inflasi;
use App\Models\PertumbuhanEkonomi;
use Illuminate\Http\Request;

class InflasiController extends Controller
{
    public function index()
    {
        $datainflasicount = Inflasi::get()->count();
        $datapertumbuhancount = PertumbuhanEkonomi::get()->count();

        $datainflasi = Inflasi::get();
        $datapertumbuhan = PertumbuhanEkonomi::get();

        $data['inflasi'] = Inflasi::get()->last();
        if ($datainflasicount > 1) {
            $nilaiinflasi = $datainflasi[$datainflasicount - 2]->prosentase - $datainflasi[$datainflasicount - 1]->prosentase;

            if ($nilaiinflasi > 0) {
                $status = 'up';
            }
            if ($nilaiinflasi < 0) {
                $status = 'down';
            }
            if ($nilaiinflasi == 0) {
                $status = 'flat';
            }
            $data['inflasi']['inflasi-perubahan'] = ['status' => $status, 'nilai' => $nilaiinflasi];
        }
        $data['pertumbuhan_ekonomi'] = PertumbuhanEkonomi::get()->last();
        if ($datapertumbuhancount > 1) {
            $nilaipertumbuhan = $datapertumbuhan[$datapertumbuhancount - 2]->prosentase - $datapertumbuhan[$datapertumbuhancount - 1]->prosentase;

            if ($nilaipertumbuhan > 0) {
                $status = 'up';
            }
            if ($nilaipertumbuhan < 0) {
                $status = 'down';
            }
            if ($nilaipertumbuhan == 0) {
                $status = 'flat';
            }
            $data['pertumbuhan_ekonomi']['pertumbuhan_ekonomi-perubahan'] = ['status' => $status, 'nilai' => $nilaipertumbuhan];
        }

        return ResponseApi::success($data);
    }
}
