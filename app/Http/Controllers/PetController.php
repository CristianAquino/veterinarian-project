<?php

namespace App\Http\Controllers;

use App\DTOs\PetDTO;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pets = Pet::query()->paginate(10);
        $petsDTO = PetDTO::fromPagination($pets);
        return response()->json($petsDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $pet = Pet::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        //
        $petDTO = PetDTO::fromBaseModel($pet);
        return response()->json($petDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        //
        $pet->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        //
        $pet->delete();
    }
}
