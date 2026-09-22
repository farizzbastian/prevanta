<?php

namespace App\Http\Requests\Auth;

use App\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s.\'\-]+$/u', Rule::unique('users', 'name')],
            'email' => ['required', 'string', 'email:rfc', 'max:255', Rule::unique('users', 'email')],
            'no_hp' => ['required', 'regex:/^08[0-9]{8,13}$/', Rule::unique('users', 'no_hp')],
            'nik' => ['required', 'digits:16', Rule::unique('orang_tua', 'nik')],
            'jenis_kelamin' => ['required', Rule::enum(Gender::class)],
            'hubungan_dengan_balita' => ['required', Rule::in(['ibu', 'ayah', 'wali'])],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()],
            'terms' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, apostrof, atau tanda hubung.',
            'name.unique' => 'Nama tersebut sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_hp.regex' => 'Nomor WhatsApp harus diawali 08 dan terdiri dari 10–15 digit.',
            'nik.digits' => 'NIK harus terdiri dari tepat 16 digit.',
            'terms.accepted' => 'Anda harus menyetujui syarat penggunaan.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'email' => mb_strtolower(trim((string) $this->input('email'))),
            'no_hp' => preg_replace('/\D+/', '', (string) $this->input('no_hp')),
            'nik' => preg_replace('/\D+/', '', (string) $this->input('nik')),
        ]);
    }
}
