<?php

namespace App\Http\Controllers;

use App\DTOs\AppointmentDTO;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $status = strtolower($request->query('status'));

        $appointments = Appointment::query()
            ->whereNot('status', 'completed')
            ->whereNot('status', 'cancelled')
            ->orderBy('updated_at', 'asc')
            ->when(
                $status,
                fn($query, $status) => $query->whereRaw('LOWER(status) = ?', $status)
            )
            ->paginate(10);

        $appointmentDTO = AppointmentDTO::fromPagination($appointments);
        return response()->json($appointmentDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Appointment::create($request->validated_data);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $appointments = Appointment::query()
            ->where('user_id', Auth::id())
            ->whereNot('status', 'completed')
            ->whereNot('status', 'cancelled')
            ->orderBy('updated_at', 'asc')
            ->paginate(10);

        $appointmentDTO = AppointmentDTO::fromPagination($appointments);
        return response()->json($appointmentDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
        // para permitir la actualización de status en el policy debemos
        // verificar que el id del usuario sea el mismo que el que está en la tabla appointments y tambien si el rol es employee(cajera) debe actualizar
        // el cajero pone in_progress o cancel
        // el vet complete o cancel
        // solo cuando se crea la cita el estado es pending
        $appointment->update([
            'status' => $request->validate_data["status"]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
        $appointment->delete();
    }
}
