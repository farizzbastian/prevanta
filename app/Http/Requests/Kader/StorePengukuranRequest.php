<?php

namespace App\Http\Requests\Kader;

use App\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StorePengukuranRequest extends FormRequest
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
        $child = $this->route('balita');
        $birthDate = $child?->tanggal_lahir?->toDateString();
        $maximumDate = $child?->tanggal_lahir?->copy()->addDays(1856)->toDateString();

        return [
            'tanggal_pengukuran' => [
                'required',
                'date',
                'before_or_equal:today',
                "after_or_equal:{$birthDate}",
                "before_or_equal:{$maximumDate}",
                Rule::unique('pengukuran')->where('balita_id', $this->route('balita')?->id),
            ],
            'berat_badan' => ['required', 'numeric', 'between:1,40'],
            'tinggi_badan' => ['required', 'numeric', 'between:30,130'],
            'lingkar_lengan_atas' => ['nullable', 'numeric', 'between:5,40'],
            'lingkar_kepala' => ['nullable', 'numeric', 'between:20,70'],
            'foto' => ['nullable', File::image()->types(['jpg', 'jpeg', 'png', 'webp'])->max(2 * 1024)],
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_pengukuran.unique' => 'Balita sudah memiliki pengukuran pada tanggal tersebut.',
            'tanggal_pengukuran.after_or_equal' => 'Tanggal pengukuran tidak boleh sebelum tanggal lahir balita.',
            'tanggal_pengukuran.before_or_equal' => 'Tanggal pengukuran harus hari ini atau sebelumnya dan berada dalam rentang usia standar WHO 0–5 tahun.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}
