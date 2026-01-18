<?php

namespace App\Http\Requests\VendedoresService;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Vendedor::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'email' => 'required|string|email|max:150',
            'telefono' => 'sometimes|nullable|string|max:20',
            'external_id' => 'required|integer|unique:vendedores,external_id',
            'lote_id' => 'required|integer|exists:lotes,id',
        ];
    }
}
