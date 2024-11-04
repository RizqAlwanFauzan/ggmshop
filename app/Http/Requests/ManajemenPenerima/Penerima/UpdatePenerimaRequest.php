<?php

namespace App\Http\Requests\ManajemenPenerima\Penerima;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePenerimaRequest extends FormRequest
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
            'nip'           => [
                'required',
                'string',
                'max:14',
                Rule::unique('penerima', 'nip')->ignore($this->penerima->id)
            ],
            'nik'           => [
                'required',
                'string',
                'max:16',
                Rule::unique('penerima', 'nik')->ignore($this->penerima->id)
            ],
            'nama'          => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:15',
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
            'nip'           => 'NIP',
            'nik'           => 'NIK',
            'nama'          => 'nama penerima',
            'nomor_telepon' => 'nomor telepon',
            'alamat'        => 'alamat'
        ];
    }
}
