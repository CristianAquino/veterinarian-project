<?php

namespace App\Http\Controllers;

use App\DTOs\InventoryDTO;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inventories = Inventory::query()->paginate(10);
        $inventoriesDTO = InventoryDTO::fromPagination($inventories);
        return response()->json($inventoriesDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Inventory::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
        // $inventory->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
        // $inventory->delete();
    }
}