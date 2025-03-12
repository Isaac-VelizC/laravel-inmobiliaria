<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'surnames' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'phone' => 'required|string|min:8|max:10|regex:/^\d{8,10}$/',
            'address' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|regex:/^[\w\.-]+@[\w\.-]+\.\w+$/',
            'ci' => 'nullable|string|max:9|regex:/^\d+$/',
            'oficina' => 'nullable|integer|exists:oficinas,id',
            'password' => 'required|string|min:8'
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'surnames.required' => 'Los apellidos son obligatorios.',
            'surnames.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.regex' => 'El teléfono debe tener entre 8 y 10 dígitos.',
            'address.regex' => 'La dirección solo puede contener letras, números, puntos, comas, guiones y espacios.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser válido.',
            'ci.regex' => 'La CI debe ser numérica.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.exists' => 'El rol no existe.',
            'oficina.exists' => 'La oficina no existe.',
        ];
    }
}
