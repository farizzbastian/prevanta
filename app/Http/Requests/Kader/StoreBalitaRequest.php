<?php

namespace App\Http\Requests\Kader;

use App\Gender;
use App\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBalitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === UserRole::Kader;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'orang_tua_id' => ['required', 'integer', Rule::exists('orang_tua', 'id')],
            'nama' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\pL\s.\'\-]+$/u'],
            'nik' => ['required', 'digits:16', Rule::unique('balita', 'nik')],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:'.today()->subYears(5)->toDateString()],
            'jenis_kelamin' => ['required', Rule::enum(Gender::class)],
            'alamat' => ['required', 'string', 'min:10', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.regex' => 'Nama balita tidak boleh berisi angka atau simbol selain titik, apostrof, dan tanda hubung.',
            'nik.digits' => 'NIK balita harus terdiri dari tepat 16 digit.',
            'nik.unique' => 'NIK balita sudah terdaftar.',
            'tanggal_lahir.after_or_equal' => 'Usia anak harus berada dalam rentang balita, maksimal 5 tahun.',
        ];
    }
}
