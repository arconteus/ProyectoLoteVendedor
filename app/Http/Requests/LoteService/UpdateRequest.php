<?php

namespace App\Http\Requests\LoteService;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', \App\Models\Lote::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:lotes,id',
            'nombre' => 'sometimes|string|max:255',
            'direccion' => 'sometimes|string|max:500',
            'identificador' => 'sometimes|string|max:100|unique:lotes,identificador,' . $this->input('id'),
            'activo' => 'sometimes|boolean',
        ];
    }
}
