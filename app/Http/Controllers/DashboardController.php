<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class DashboardController extends Controller
{

    public function index()
    {
        $audits = Audit::with('user')
            ->latest()
            ->take(20)
            ->get();

            // dd($audits); // <-- TAMBahkan ini dulu buat test
        return view('dashboard' , compact('audits'));
    }
}
