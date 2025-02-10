<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certification;

class CertificationSeeder extends Seeder
{
    public function run()
    {
        Certification::create([
            'user_id' => 1,
            'name' => 'PMP',
            'issuing_organization' => 'Wolff, Bode and Senger',
            'issue_date' => '2023-09-11',
            'expiry_date' => '2026-12-13',
            'credential_id' => '065e30e5-6dea-3a9d-a421-a7b9b4366852',
            'credential_url' => 'http://schiller.com/quibusdam-odio-veniam-quam-ipsam-nostrum',
        ]);
    }
} 