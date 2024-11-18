<?php

namespace App\Http\Requests\ManajemenProdukSupplier\ProdukKategori\Produk;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProdukRequest extends FormRequest
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
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('produk', 'nama')->ignore($this->produk->id)->where(
                    fn(Builder $query) =>
                    $query
                        ->where('kategori_id', $this->input('kategori_id'))
                        ->where('supplier_id', $this->input('supplier_id'))
                )
            ],
            'kategori_id'  => 'required|exists:kategori,id',
            'supplier_id'  => 'required|exists:supplier,id',
            'deskripsi'    => 'nullable|string|max:500',
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
            'nama'         => 'nama produk',
            'kategori_id'  => 'kategori',
            'supplier_id'  => 'supplier',
            'deskripsi'    => 'deskripsi'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.unique' => 'Produk dengan nama, kategori, dan supplier yang sama sudah ada.',
        ];
    }
}
