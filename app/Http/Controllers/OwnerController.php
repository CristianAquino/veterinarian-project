<?php

namespace App\Http\Controllers;

use App\DTOs\OwnerDTO;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $dni = strtolower($request->query('dni'));

        $owners = Owner::query()
            ->when(
                $dni,
                fn($query, $dni) => $query->whereRaw('dni LIKE ?', "%$dni%")
            )
            ->paginate(10);

        $ownersDTO = OwnerDTO::fromPagination($owners);
        return response()->json($ownersDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request->validated_data);
        // Owner::create($request->validated_data);
        // return redirect(route('employees.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        //
        $ownerDTO = OwnerDTO::fromModelWithRelation($owner);
        return response()->json($ownerDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owner $owner)
    {
        //
        // $owner->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        //
        // $owner->delete();
    }
}
