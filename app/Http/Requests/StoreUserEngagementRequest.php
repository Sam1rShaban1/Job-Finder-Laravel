<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserEngagementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'metric_type' => ['required', 'in:profile_view,application_rate,search_activity'],
            'value' => ['required', 'numeric'],
            'measured_at' => ['required', 'date']
        ];
    }
} 