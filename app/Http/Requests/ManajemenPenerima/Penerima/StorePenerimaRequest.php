<?php

namespace App\Http\Requests\ManajemenPenerima\Penerima;

use Illuminate\Foundation\Http\FormRequest;

class StorePenerimaRequest extends FormRequest
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
            'nip'           => 'required|string|max:14|unique:penerima,nip',
            'nik'           => 'required|string|max:16|unique:penerima,nik',
            'nama'          => 'required|string|max:255',
            'departemen_id' => 'required|exists:departemen,id',
            'bagian_id'     => 'nullable|exists:bagian,id',
            'status_id'     => 'required|exists:status,id',
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
            'departemen_id' => 'departemen',
            'bagian_id'     => 'bagian',
            'status_id'     => 'status',
            'nomor_telepon' => 'nomor telepon',
            'alamat'        => 'alamat'
        ];
    }
}
