<?php

namespace App\Http\Requests\ManajemenPenerima\Kuota;

use Illuminate\Foundation\Http\FormRequest;

class StoreKuotaRequest extends FormRequest
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
            'penerima_id' => 'required|exists:penerima,id|unique:kuota,penerima_id',
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
