<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class RekapDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $rekapdata = Antrian::all();

        return view('dashboard.rekap', ['rekapdata' => $rekapdata]);
    }

    public function detail($id)
    {
        $data = Antrian::where('id', $id)->first();

        return view('dashboard.detail_rekap', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Antrian::where('id', $id)->first();

        return view('dashboard.edit_rekap', ['data' => $data]);
    }
}
