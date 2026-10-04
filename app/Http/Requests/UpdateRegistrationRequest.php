<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Prepare input before validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'category' => strtolower((string) $this->category),
            'parent_phone' => preg_replace('/[^0-9+]/', '', (string) $this->parent_phone),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:3', 'max:255'],
            'birth_date' => ['required', 'date', 'before:today'],
            'category' => ['required', 'string', 'in:sd,smp'],
            'school' => ['required', 'string', 'min:2', 'max:255'],
            'parent_name' => ['required', 'string', 'min:3', 'max:255'],
            'parent_phone' => [
                'required',
                'string',
                'regex:/^(?:\+62|62|08)[0-9]{7,13}$/'
            ],
            'address' => ['required', 'string', 'min:5'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.min' => 'Nama lengkap minimal 3 karakter.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'birth_date.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'birth_date.before' => 'Tanggal lahir harus sebelum hari ini.',
            'category.required' => 'Kategori peserta wajib dipilih.',
            'category.in' => 'Kategori peserta hanya boleh SD atau SMP.',
            'school.required' => 'Asal sekolah wajib diisi.',
            'parent_name.required' => 'Nama orang tua/wali wajib diisi.',
            'parent_name.min' => 'Nama orang tua/wali minimal 3 karakter.',
            'parent_phone.required' => 'Nomor HP orang tua/wali wajib diisi.',
            'parent_phone.regex' => 'Nomor HP tidak valid. Gunakan format nomor Indonesia (contoh: 081234567890).',
            'address.required' => 'Silakan masukkan alamat lengkap.',
            'address.min' => 'Alamat minimal 5 karakter.',
        ];
    }
}
