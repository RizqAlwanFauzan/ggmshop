<?php

namespace App\Http\Requests\ManajemenProdukSupplier\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'nama'          => 'required|string|max:255|unique:supplier,nama',
            'email'         => 'nullable|email|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'alamat'        => 'required|string|max:500'
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
            'nama'          => 'nama supplier',
            'email'         => 'email',
            'nomor_telepon' => 'nomor telepon',
            'alamat'        => 'alamat'
        ];
    }
}
