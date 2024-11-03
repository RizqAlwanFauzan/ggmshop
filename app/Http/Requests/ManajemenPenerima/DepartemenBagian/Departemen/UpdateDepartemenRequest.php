<?php

namespace App\Http\Requests\ManajemenPenerima\DepartemenBagian\Departemen;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartemenRequest extends FormRequest
{
    protected $errorBag = 'update';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama'      => [
                'required',
                'string',
                'max:255',
                Rule::unique('departemen', 'nama')->ignore($this->departemen->id)
            ],
            'deskripsi' => 'nullable|string|max:500'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nama'      => 'nama departemen',
            'deskripsi' => 'deskripsi'
        ];
    }
}
