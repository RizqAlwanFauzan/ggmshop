<?php

namespace App\Http\Requests\ManajemenPenerima\DepartemenBagian\Bagian;

use Illuminate\Foundation\Http\FormRequest;

class StoreBagianRequest extends FormRequest
{
    protected $errorBag = 'store';

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
            'nama'      => 'required|string|max:255|unique:bagian,nama',
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
            'nama'      => 'nama bagian',
            'deskripsi' => 'deskripsi'
        ];
    }
}
