<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCctvRequestRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_klien' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:50',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian' => 'required',
            'posisi_cctv' => 'required|string|max:255',
            'alasan_kronologi' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ];
    }
}
