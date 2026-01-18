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
        $id = $this->route('id');
        $vendedor = \App\Models\Vendedor::find($id);
        return $vendedor && $this->user()->can('update', $vendedor);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'nombre' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|email|max:150',
            'telefono' => 'sometimes|nullable|string|max:20',
            'external_id' => 'sometimes|integer|unique:vendedores,external_id,' . $id,
            'lote_id' => 'sometimes|integer|exists:lotes,id',
        ];
    }
}
