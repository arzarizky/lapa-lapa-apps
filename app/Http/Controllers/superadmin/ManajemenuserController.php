<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManajemenuserController extends Controller
{
    public function index()
    {
        $data = User::role(['admin'])->get();

        $kota = Kota::get();

        return view('super-admin.manajemen-user.index', compact(['data', 'kota']));
    }

    public function post(Request $request)
    {
        if ($request->has('password')) {
            if ($request->input('password') != $request->input('passwordsecond')) {
                return redirect()->back()->with('error', 'Password Tidak sama!!!');
            }
        }

        if ($request->has('foto')) {
            Storage::putFile(
                'public/admin',
                $request->file('foto')
            );
            // dd($request->file('foto')->hashName());
            $path = $request->file('foto')->hashName();
        }

        $data =  User::create([
            'name' => $request->input('nama_depan'),
            'last_name' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
            'kota_id' => $request->input('kota_id'),
            'foto' => $path,
            'password' => Hash::make($request->input('password')),
        ]);

        $data->assignRole('Admin');
        return redirect()->back()->with('success', 'Berhasil tambah User');
    }

    public function edit(Request $request)
    {
        if ($request->has('password')) {
            if ($request->input('password') != $request->input('passwordsecond')) {
                return redirect()->back()->with('error', 'Password Tidak sama!!!');
            } else {
                User::where('id', $request->input('id'))->update([
                    'password' => Hash::make($request->input('password')),
                ]);
            }
        }

        if ($request->has('foto')) {
            Storage::putFile(
                'public/admin',
                $request->file('foto')
            );
            // dd($request->file('foto')->hashName());
            $path = $request->file('foto')->hashName();
            $foto = User::where('id', $request->input('id'))->first();
            if (Storage::exists('public/admin/' . $foto->foto)) {
                Storage::delete('public/admin/' . $foto->foto);
            }
            User::where('id', $request->input('id'))->update([
                'foto' => $path,
            ]);
        }

        User::where('id', $request->input('id'))->update([
            'name' => $request->input('nama_depan'),
            'last_name' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
            'kota_id' => $request->input('kota_id'),
        ]);



        return redirect()->back()->with('success', 'Berhasil edit User');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil delete User');
    }
}
