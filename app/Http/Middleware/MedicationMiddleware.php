<?php

namespace App\Http\Middleware;

use App\Models\Medication;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MedicationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            'name' => ['required', 'string', 'max:32'],
            'description' => ['sometimes', 'string'],
            'type' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {

                    if (!in_array(strtolower($value), Medication::TYPE)) {
                        $fail('The type must be a valid type.');
                    }
                }
            ]
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            // necesario para tratar los valores en el front
            return back()->withErrors($validate->errors())->withInput();
        }

        $request->merge(['validated_data' => $validate->validated()]);
        return $next($request);
    }
}
