<?php

namespace App\Http\Controllers;

use App\DTOs\PrescriptionDTO;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $prescriptions = Prescription::query()->paginate(10);
        $prescriptionsDTO = PrescriptionDTO::fromPagination($prescriptions);
        return response()->json($prescriptionsDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Prescription::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        //
        // $prescription->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        //
        // $prescription->delete();
    }
}