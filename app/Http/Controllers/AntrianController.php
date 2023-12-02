<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian; // Update the namespace based on your model's location

class AntrianController extends Controller
{
    public function index()
    {
        return view('dashboard.antrian');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'nomor' => 'required|integer', // Adjust the validation rules based on your requirements
            // Add other fields as needed
        ]);

        // Create a new Antrian instance and fill it with the request data
        $antrian = new Antrian;
        $antrian->nomor = $request->input('nomor');
        // Set other fields here

        // Save the new Antrian record to the database
        $antrian->save();

        // Redirect to the index page or any other page after the record is saved
        return redirect()->route('antrian.index');
    }

    public function update(Request $request, $created_at)
    {
        // Validate the incoming request data
        $request->validate([
            'nomor' => 'required|integer', // Adjust the validation rules based on your requirements
            // Add other fields as needed
        ]);

        // Find the Antrian record by created_at
        $antrian = Antrian::where('created_at', $created_at)->first();

        if (!$antrian) {
            // Handle the case where the record is not found
            return response()->json(['error' => 'Record not found.'], 404);
        }

        // Optimistically update the Antrian record with the request data
        $antrian->nomor = $request->input('nomor');
        // Update other fields here

        // Save the updated Antrian record to the database
        $antrian->save();

        // Assuming the save was successful, return the updated resource as JSON
        return response()->json($antrian);

        // If you encounter an error during the save, you can handle it accordingly
        // try {
        //     $antrian->save();
        //     return response()->json($antrian);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'Failed to update.'], 500);
        // }
    }

    public function increase(Request $request)
    {

        $created_at = $request->input('created_at');

        $antrian = Antrian::where('created_at', $created_at)->first();
    
        if (!$antrian) {
            $antrian = new Antrian;
            $antrian->created_at = $created_at;
            $antrian->jumlah = 1;
        } else {
            $antrian->increment('jumlah', 1);
        }
    
        $antrian->save();
    
        return response()->json($antrian);
    }    
}
