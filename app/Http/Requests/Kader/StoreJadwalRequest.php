<?php

namespace App\Http\Requests\Kader;

use App\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class StoreJadwalRequest extends FormRequest
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
            'jenis_kegiatan' => ['required', 'string', 'min:3', 'max:100'],
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'lokasi' => ['required', 'string', 'min:3', 'max:150'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
