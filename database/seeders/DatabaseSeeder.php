<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        CompanySetting::query()->firstOrCreate(
            ['company_name' => 'Nexa Digital'],
            [
                'tagline' => 'Digital systems for ambitious teams.',
                'description' => 'Kami membantu bisnis membangun fondasi digital yang cepat, aman, dan siap berkembang.',
                'email' => 'hello@example.com',
                'phone' => '+62 812 3456 7890',
                'address' => 'Jakarta, Indonesia',
            ],
        );
    }
}
