<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AppointmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            'status' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!in_array(strtolower($value), Appointment::STATUS)) {
                        $fail('The status must be a valid status.');
                    }
                },
            ],
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($request->isMethod('post')) {
            $rules['date'][] = 'required|date';
            $rules['start_time'][] = 'required|date_format:H:i';
            $rules['reason'][] = 'sometimes|string';
            $rules['is_emergency'][] = 'bool';
            $rules['user_id'][] = 'required|integer|exists:users,id';
            $rules['owner_id'][] = 'required|integer|exists:owners,id';
        }

        if ($validate->fails()) {
            // necesario para tratar los valores en el front
            return back()->withErrors($validate->errors())->withInput();
        }

        $request->merge(['validated_data' => $validate->validated()]);
        return $next($request);
    }
}