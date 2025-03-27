<?php

namespace App\Http\Middleware;

use App\Models\Pet;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PetMiddleware
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
            'species' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!in_array(strtolower($value), Pet::SPECIES)) {
                        $fail('The species must be a valid species.');
                    }
                },
            ],
            'breed' => ['sometimes', 'string'],
            'age' => ['sometimes', 'integer', 'min:0'],
            'weight' => ['sometimes', 'numeric', 'min:0'],
            'gender' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!in_array(strtolower($value), Pet::GENDER)) {
                        $fail('The gender must be a valid genders.');
                    }
                },
            ],
            'owner_id' => ['required', 'integer', 'exists:owners,id']
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->merge(['validated_data' => $validate->validated()]);

        return $next($request);
    }
}
