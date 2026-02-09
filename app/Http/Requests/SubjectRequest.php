<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('subject') ? $this->route('subject')->id : null;

        return [
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('subjects')->ignore($id)->whereNull('deleted_at'),
            ],
            'study_program_id' => 'required|exists:study_programs,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama mata kuliah wajib diisi.',
            'code.required' => 'Kode mata kuliah wajib diisi.',
            'code.unique' => 'Kode mata kuliah sudah digunakan.',
            'study_program_id.required' => 'Program studi wajib dipilih.',
            'study_program_id.exists' => 'Program studi tidak valid.',
        ];
    }
}
