<?php

namespace App\Http\Controllers\dev;

use App\Http\Controllers\Controller;
use App\Models\Jenispasar;
use App\Models\Kota;
use App\Models\Pemilik;
use App\Models\Rekapharga;
use App\Models\Subkomoditas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DevController extends Controller
{
    public function fullData()
    {
        $pemiliks = Pemilik::get();
        foreach ($pemiliks as $pemilik) {
            $rekapHarga = Rekapharga::where('pemilik_id', $pemilik->id)->orderBy('tanggal', 'desc')->first();

            // dd($tanggal->addDays(1)->format('Y-m-d'));

            if ($rekapHarga) {
                $tanggal = Carbon::createFromFormat('Y-m-d', $rekapHarga->tanggal);
                while ($tanggal->format('Y-m-d') < Carbon::now()->format('Y-m-d')) {
                    # code...
                    $tanggal->addDays(1)->format('Y-m-d');
                    $newRekapHarga = new Rekapharga();
                    $newRekapHarga->pemilik_id = $rekapHarga->pemilik_id;
                    $newRekapHarga->harga = $rekapHarga->harga;
                    $newRekapHarga->dk = $rekapHarga->dk;
                    $newRekapHarga->dp = $rekapHarga->dp;
                    $newRekapHarga->useredit_id = null;
                    $newRekapHarga->tanggal = $tanggal->format('Y-m-d');
                    $newRekapHarga->save();
                }
            } else {
                $tanggal = Carbon::createFromFormat('Y-m-d', '2021-05-22');
                $newRekapHarga = new Rekapharga();
                $newRekapHarga->pemilik_id = $pemilik->id;
                $newRekapHarga->harga = 10000;
                $newRekapHarga->dk = 0;
                $newRekapHarga->dp = 0;
                $newRekapHarga->useredit_id = null;
                $newRekapHarga->tanggal = $tanggal->format('Y-m-d');
                $newRekapHarga->save();
            }
        }

        return true;
    }

    public function createPemilik()
    {
        $kotas = Kota::get();
        foreach ($kotas as $kota) {

            $subkomoditass = Subkomoditas::get();
            foreach ($subkomoditass as $subkomoditas) {

                $pasars = Jenispasar::get();
                foreach ($pasars as $pasar) {
                    if (!Pemilik::where('pasar_id', $pasar->id)->where('kota_id', $kota->id)->where('subkomoditas_id', $subkomoditas->id)->where('komoditas_id', $subkomoditas->komoditas_id)->first()) {
                        $pemilik = new Pemilik();
                        $pemilik->komoditas_id = $subkomoditas->komoditas_id;
                        $pemilik->subkomoditas_id = $subkomoditas->id;
                        $pemilik->kota_id = $kota->id;
                        $pemilik->pasar_id = $pasar->id;
                        $pemilik->save();
                    }
                }
            }
        }

        return true;
    }
}
