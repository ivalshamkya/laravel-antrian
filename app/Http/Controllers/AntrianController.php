<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;

class AntrianController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['index']);
    }

    public function index()
    {
        $antrian = Antrian::where('created_at', date('Y-m-d'))->first();
        return view('dashboard.antrian', ['antrian' => $antrian]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
        ]);

        $antrian = new Antrian;
        $antrian->jumlah = $request->input('jumlah');

        $antrian->save();

        return redirect()->route('antrian.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'jumlah' => 'required|integer',
            'created_at' => 'required|date',
        ]);

        $antrian = Antrian::where('id', $request->input('id'))->first();

        if (!$antrian) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $antrian->jumlah = $request->input('jumlah');
        $antrian->created_at = $request->input('created_at');

        $antrian->save();

        return response()->json($antrian);
    }

    public function resetAntrian(Request $request)
    {
        $request->validate([
            'created_at' => 'required|date',
        ]);

        $antrian = Antrian::where('created_at', $request->input('created_at'))->first();

        if (!$antrian) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $antrian->jumlah = 1;

        $antrian->save();

        return response()->json($antrian);
    }

    public function increase(Request $request)
    {

        $created_at = $request->input('created_at');

        $antrian = Antrian::where('created_at', $created_at)->first();
    
        if (!$antrian) {
            $antrian = new Antrian;
            $antrian->created_at = $created_at;
            $antrian->jumlah = 2;
        } else {
            $antrian->increment('jumlah', 1);
        }
    
        $antrian->save();
    
        return response()->json($antrian);
    }  
    
    public function decrease(Request $request)
    {

        $created_at = $request->input('created_at');

        $antrian = Antrian::where('created_at', $created_at)->first();
    
        if (!$antrian) {
            $antrian = new Antrian;
            $antrian->created_at = $created_at;
            $antrian->jumlah = 2;
        } else {
            $antrian->decrement('jumlah', 1);
        }
    
        $antrian->save();
    
        return response()->json($antrian);
    }  

    public function destroy($id)
    {
        $antrian = Antrian::where('id', $id)->first();

        if (!$antrian) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $antrian->delete();

        return response()->json(['message' => 'Record deleted successfully']);
    }
}
