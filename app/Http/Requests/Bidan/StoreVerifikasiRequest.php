<?php

namespace App\Http\Requests\Bidan;

use App\UserRole;
use App\VerificationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVerifikasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === UserRole::Bidan;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(VerificationStatus::class)],
            'catatan_penyuluhan' => ['nullable', 'string', 'max:2000'],
            'tindak_lanjut' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }
}
