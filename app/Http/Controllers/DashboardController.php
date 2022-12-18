<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $mahasiswas = Mahasiswa::count();
        $ukms = Ukm::count();

        return view('dashboard', compact('mahasiswas','ukms'));
    }
}
