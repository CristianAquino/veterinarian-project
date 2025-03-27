<?php

namespace App\Http\Controllers;

use App\DTOs\ServiceDTO;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $product = strtolower($request->query('product'));

        $services = Service::query()
            ->when(
                $product,
                fn($query, $product) => $query->whereRaw('LOWER(name) LIKE ?', "%$product%")
            )->paginate(10);

        $servicesDTO = ServiceDTO::fromPagination($services);
        return response()->json($servicesDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Service::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
        // $service->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
        $service->delete();
    }
}
