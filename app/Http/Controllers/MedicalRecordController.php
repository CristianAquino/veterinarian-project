<?php

namespace App\Http\Controllers;

use App\DTOs\MedicalRecordDTO;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $medicalRecords = MedicalRecord::query()->paginate(10);
        $medicalRecordsDTO = MedicalRecordDTO::fromPagination($medicalRecords);
        return response()->json($medicalRecordsDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        //
        $medicalRecord->delete();
        // try {
        //     $medicalRecord->delete();
        //     return response()->json(['message' => 'Medical record deleted successfully']);
        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'Error deleting medical record'], 500);
        // }
    }
}
