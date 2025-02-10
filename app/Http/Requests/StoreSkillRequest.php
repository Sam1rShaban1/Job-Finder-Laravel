<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'skills' => ['required', 'array'],
            'skills.*.name' => ['required', 'string', 'max:255'],
            'skills.*.proficiency' => ['required', 'integer', 'min:1', 'max:10']
        ];
    }
} 