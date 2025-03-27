<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PrescriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            'medication_name' => ['sometimes', 'string', 'max:32'],
            'dosage' => ['required', 'string', 'max:32'],
            'notes' => ['sometimes', 'string'],
            'medical_record_id' => ['required', 'integer', 'exists:medical_records,id'],
            'medication_id' => ['sometimes', 'integer', 'exists:medications,id'],
            'employee_id' => ['required', 'integer', 'exists:users,id'],
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->merge(['validated_data' => $validate->validated()]);
        return $next($request);
    }
}