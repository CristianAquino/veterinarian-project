<?php

namespace App\Http\Controllers;

use App\DTOs\AlertDTO;
use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $alerts = Alert::query()->paginate(10);
        $alertsDTO = AlertDTO::fromPagination($alerts);
        return response()->json($alertsDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Alert::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alert $alert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alert $alert)
    {
        //
        // $alert->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alert $alert)
    {
        //
        // $alert->delete();
    }
}