<?php

namespace App\Http\Requests\LoteService;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', \App\Models\Lote::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'orderBy' => 'sometimes|string|in:id,nombre,direccion,identificador,activo,created_at,updated_at',
            'orderDirection' => 'sometimes|string|in:asc,desc',
            'q' => 'sometimes|string',
            'where' => 'sometimes|array',
            'where.*' => 'sometimes',
        ];
    }
}
