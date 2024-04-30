<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $role = auth()->user()->roles[0]->name;
        if ($role == "Super Admin") {
            User::where('id', auth()->user()->id)->update(['kota_id' => 1]);
            return redirect()->route('superadmin.dashboard.index');
        }
        return redirect()->route('admin.dashboard.index');
    }
}
