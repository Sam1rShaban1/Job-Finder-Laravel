<?php

namespace App\Http\Traits;

trait ProfileCompletion
{
    public function calculateProfileCompletion(): int
    {
        $user = auth()->user();
        $requiredFields = [
            'name', 'email', 'phone', 'address',
            'date_of_birth', 'nationality'
        ];

        $completed = 0;
        foreach ($requiredFields as $field) {
            if (!empty($user->$field)) {
                $completed++;
            }
        }

        return (int) round(($completed / count($requiredFields)) * 100);
    }
} 