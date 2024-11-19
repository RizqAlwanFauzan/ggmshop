<?php

namespace App\Http\Requests\ManajemenPenerima\Kuota;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKuotaRequest extends FormRequest
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
            'penerima_id' => [
                'required',
                'exists:penerima,id',
                Rule::unique('kuota', 'penerima_id')->ignore($this->kuota->id)
            ],
            'produk_id'   => 'required|exists:produk,id',
            'jumlah'      => 'required|integer|min:1',
            'deskripsi'   => 'nullable|string|max:500'
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
            'penerima_id' => 'nama penerima',
            'produk_id'   => 'nama produk',
            'jumlah'      => 'jumlah',
            'deskripsi'   => 'deskripsi'
        ];
    }
}
