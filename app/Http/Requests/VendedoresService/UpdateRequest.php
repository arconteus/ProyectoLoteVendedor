<?php

namespace App\Http\Requests\VendedoresService;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', \App\Models\Vendedor::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:vendedores,id',
            'nombre' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|email|max:150',
            'telefono' => 'sometimes|nullable|string|max:20',
            'external_id' => 'sometimes|integer|unique:vendedores,external_id,' . $this->route('id'),
            'lote_id' => 'sometimes|integer|exists:lotes,id',
        ];
    }
}
