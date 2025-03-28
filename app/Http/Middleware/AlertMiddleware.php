<?php

namespace App\Http\Middleware;

use App\Models\Alert;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AlertMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            'message' => ['required', 'string'],
            'type' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {

                    if (!in_array(strtolower($value), Alert::STATUS)) {
                        $fail('The type must be a valid types.');
                    }
                }
            ],
            'inventory_id' => ['required', 'integer', 'exists:inventories,id'],
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->merge(['validated_data' => $validate->validated()]);
        return $next($request);
    }
}