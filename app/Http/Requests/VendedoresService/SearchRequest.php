<?php

namespace App\Http\Requests\VendedoresService;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', \App\Models\Vendedor::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'orderBy' => 'sometimes|string|in:id,nombre,email,telefono,external_id,lote_id,created_at,updated_at',
            'orderDirection' => 'sometimes|string|in:asc,desc',
            'q' => 'sometimes|string',
            'where' => 'sometimes|array',
            'where.*' => 'string|in:id,nombre,email,telefono,external_id,lote_id,created_at,updated_at',
        ];
    }
}
