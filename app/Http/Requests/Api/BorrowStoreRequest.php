<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BorrowStoreRequest extends FormRequest
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
    'equipment_id' => ['required','exists:equipment,id'],
    'due_at'       => ['nullable','date'], // ถ้าไม่ส่ง จะ +7 วันใน controller
    'note'         => ['nullable','string','max:255'],
  ];
}
}
