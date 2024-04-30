<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {

        if ($request->input('password') == $request->input('passwordsecond')) {
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->input('password')),
            ]);
        } else {
            return redirect()->back()->with('error', 'Password harus sama');
        }

        if ($request->has('foto')) {
            Storage::putFile(
                'public/admin',
                $request->file('foto')
            );
            // dd($request->file('foto')->hashName());
            $path = $request->file('foto')->hashName();
            $foto = User::where('id', auth()->user()->id)->first();
            if (Storage::exists('public/admin/' . $foto->foto)) {
                Storage::delete('public/admin/' . $foto->foto);
            }
            User::where('id', auth()->user()->id)->update([
                'foto' => $path,
            ]);
        }

        User::where('id', auth()->user()->id)->update([
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Berhasil Edit Profil!!');
    }
}
