<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmployeeMiddleware
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
            'password' => ['required', 'string', 'min:8'],
            'role' => [
                'sometimes',
                'string',
                function ($attribute, $value, $fail) {
                    if (!in_array(strtolower($value), User::ROLE)) {
                        $fail('The role must be a valid.');
                    }
                }
            ],
            'speciality' => ['sometimes', 'string', 'max:64'],
            'phone' => ['sometimes', 'string'],
            'email' => ['required', 'email'],
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
            $rules['email'][] = 'unique:users,email';
            $rules['dni'][] = 'unique:users,dni';
            $rules['phone'][] = 'unique:users,phone';
        } elseif ($request->isMethod('put') || $request->isMethod('patch')) {
            $rules['email'][] = 'unique:users,email,' . $request->route('employee')->id;
            $rules['dni'][] = 'unique:users,dni,' . $request->route('employee')->id;
            $rules['phone'][] = 'unique:users,phone' . $request->route('employee')->id;
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