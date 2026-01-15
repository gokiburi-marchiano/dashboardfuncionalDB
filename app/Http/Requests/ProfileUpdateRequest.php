<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 1. Nombre (Obligatorio)
            'name' => ['required', 'string', 'max:255'],

            // 2. Email (Obligatorio y debe ser único, excepto para el usuario actual)
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            // 3. RUT (Mantenemos tu lógica original)
            'rut' => [
                'required',
                'string',
                'max:12',
                Rule::unique(User::class)->ignore($this->user()->id),
                'rut', // Tu validador personalizado
            ],

            // 4. NUEVOS CAMPOS (Opcionales 'nullable', pero si vienen, deben ser texto)
            'apellido_paterno' => ['nullable', 'string', 'max:255'],
            'apellido_materno' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'cargo' => ['nullable', 'string', 'max:100'],
            'unidad' => ['nullable', 'string', 'max:100'],
        ];
    }
}
