<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            'name' => ['required', 'string', 'max:64'],
            'surname' => ['required', 'string', 'max:64'],
            'phone' => ['sometimes', 'string'],
            'email' => ['sometimes', 'email'],
            'dni' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (strlen($value) !== 8) {
                        $fail('The DNI must contain 8 characters.');
                    }
                }
            ],
        ];

        if ($request->isMethod('post')) {
            $rules['email'][] = 'unique:owners,email';
            $rules['dni'][] = 'unique:owners,dni';
        } elseif ($request->isMethod('put') || $request->isMethod('patch')) {
            $rules['email'][] = 'unique:owners,email,' . $request->route('owner')->id;
            $rules['dni'][] = 'unique:owners,dni,' . $request->route('owner')->id;
        }

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            // necesario para tratar los valores en el front
            return back()->withErrors($validate->errors())->withInput();
        }

        $request->merge(['validated_data' => $validate->validated()]);
        return $next($request);
    }
}