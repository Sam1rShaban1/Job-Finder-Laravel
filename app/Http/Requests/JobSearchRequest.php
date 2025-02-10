<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'keywords' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:100',
            'job_type' => 'nullable|in:full-time,part-time,contract,freelance',
            'experience' => 'nullable|in:entry,mid,senior',
            'salary_min' => 'nullable|numeric|min:0'
        ];
    }
} 