<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string|max:1000',
            'receiver_id' => 'required|exists:users,id',
            'job_listing_id' => 'nullable|exists:job_listings,id'
        ];
    }
} 