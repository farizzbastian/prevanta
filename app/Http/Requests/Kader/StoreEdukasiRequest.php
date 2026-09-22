<?php

namespace App\Http\Requests\Kader;

use App\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreEdukasiRequest extends FormRequest
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
            'judul' => ['required', 'string', 'min:8', 'max:160'],
            'kategori' => ['required', Rule::in(['Gizi', 'Tumbuh Kembang', 'Imunisasi', 'Pola Asuh'])],
            'konten' => ['required', 'string', 'min:50', 'max:20000'],
            'gambar' => ['nullable', File::image()->types(['jpg', 'jpeg', 'png', 'webp'])->max(2 * 1024)],
        ];
    }
}
