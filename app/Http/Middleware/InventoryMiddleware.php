<?php

namespace App\Http\Middleware;

use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class InventoryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            'batch_number' => ['required', 'string', 'max:52'],
            'quantity' => ['required', 'integer', 'min:1'],
            'expiry_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $date = DateTime::createFromFormat('Y-m-d', $value);
                    $currentDate = now();
                    $difference = $currentDate->diff($date);

                    if (!$date || $date->format('Y-m-d') != $value) {
                        $fail("The start date $value is not in Y/m/d format or is an invalid date");
                    }
                    if ($difference->days <= 0) {
                        $fail("The expiry date must be greater than the current date");
                    }
                },
            ],
            'expired' => ['sometimes', 'bool'],
            'unit_price' => ['required', 'numeric', 'min:0'],
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