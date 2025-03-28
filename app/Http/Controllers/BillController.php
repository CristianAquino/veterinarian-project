<?php

namespace App\Http\Controllers;

use App\DTOs\BillDTO;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bills = Bill::query()->paginate(10);
        $billsDTO = BillDTO::fromPagination($bills);
        return response()->json($billsDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Bill::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
        // $bill->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
        // $bill->delete();
    }
}