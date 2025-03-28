<?php

namespace App\Http\Controllers;

use App\DTOs\MedicationDTO;
use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $medications = Medication::query()->paginate(10);
        $medicationsDTO = MedicationDTO::fromPagination($medications);
        return response()->json($medicationsDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Medication::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medication $medication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medication $medication)
    {
        //
        // $medication->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medication $medication)
    {
        //
        // $medication->delete();
    }
}
