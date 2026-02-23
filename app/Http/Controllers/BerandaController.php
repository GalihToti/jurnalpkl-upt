<?php
// app/Http/Controllers/BerandaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prakerin;
use App\Models\Jurnal;

class BerandaController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalPrakerin = Prakerin::count();
        $totalJurnal = Jurnal::count();

        // Mengirim data ke view welcome
        return view('welcome', compact('totalPrakerin', 'totalJurnal'));
    }
}
