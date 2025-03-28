<?php

namespace App\Http\Controllers;

use App\DTOs\BillItemDTO;
use App\Models\BillItem;
use Illuminate\Http\Request;

class BillItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $billItems = BillItem::query()->paginate(10);
        $billItemsDTO = BillItemDTO::fromPagination($billItems);
        return response()->json($billItemsDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // BillItem::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(BillItem $billItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillItem $billItem)
    {
        //
        // $billItem->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillItem $billItem)
    {
        //
        // $billItem->delete();
    }
}