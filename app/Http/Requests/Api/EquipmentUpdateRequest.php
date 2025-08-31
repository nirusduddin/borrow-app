<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentUpdateRequest extends FormRequest
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
        $id = $this->route('equipment')->id;
        return [
            'equipment_category_id' => ['sometimes','exists:equipment_categories,id'],
            'code'  => ['sometimes','string','max:50',"unique:equipment,code,{$id}"],
            'name'  => ['sometimes','string','max:100'],
            'stock' => ['sometimes','integer','min:0'],
            'photo' => ['nullable','file','image','max:2048'],
        ];
    }
}
