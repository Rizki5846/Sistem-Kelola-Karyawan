<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('HRIS_ADMIN_EMAIL');
        $password = env('HRIS_ADMIN_PASSWORD');

        if (blank($email) || blank($password)) {
            throw new RuntimeException(
                'Isi HRIS_ADMIN_EMAIL dan HRIS_ADMIN_PASSWORD di .env.'
            );
        }

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => env('HRIS_ADMIN_NAME', 'Administrator HRIS'),
                'password' => Hash::make($password),
            ]
        );

        $user->assignRole('HRD');
    }
}