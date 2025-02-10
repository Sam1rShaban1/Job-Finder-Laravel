<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobPerformanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_listing_id' => 'required|exists:job_listings,id',
            'metric_date' => 'required|date',
            'views' => 'required|integer',
            'applications' => 'required|integer'
        ];
    }
} 