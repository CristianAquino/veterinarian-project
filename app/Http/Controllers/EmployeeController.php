<?php

namespace App\Http\Controllers;

use App\DTOs\EmployeeDTO;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

// esto es para el admin
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // mostramos todos los empleados
        // el admin no ve su data, pues la vera en el perfil
        $role = strtolower($request->query('role'));
        $speciality = strtolower($request->query('speciality'));
        $surname = strtolower($request->query('surname'));

        $users = User::query()
            ->whereNot('id', Auth::id())
            ->when(
                $role,
                fn($query, $role) => $query->whereRaw('LOWER(role)= ?', $role)
            )
            ->when(
                $speciality,
                fn($query, $speciality) => $query->whereRaw('LOWER(speciality) LIKE ?', "%$speciality%")
            )
            ->when(
                $surname,
                fn($query, $surname) => $query->whereRaw('LOWER(surname) LIKE ?', "%$surname%")
            )
            ->paginate(10);

        $usersDTO = EmployeeDTO::fromPagination($users);
        return response()->json($usersDTO);

        // return Inertia::render('Employees/Index', [
        //     'users' => $usersDTO,
        //     'filters' => ['role' => $role, 'speciality' => $speciality]
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request->validated_data);
        // User::create($request->validated_data);
        // return redirect(route('employees.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $employee)
    {
        //
        $employeeDTO = EmployeeDTO::toData($employee);
        return response()->json($employeeDTO);
        // return Inertia::render('Employees/Index', [
        //     'info' => $employeeDTO
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $employee)
    {
        //
        // $employee->update($request->validated_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $employee)
    {
        //
        // $employee->delete();
    }
}
