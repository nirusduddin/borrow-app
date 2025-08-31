<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'equipment_category_id' => ['required','exists:equipment_categories,id'],
            'code'  => ['required','string','max:50','unique:equipment,code'],
            'name'  => ['required','string','max:100'],
            'stock' => ['required','integer','min:0'],
            'photo' => ['nullable','file','image','max:2048'], // multipart
        ];
    }
}
