<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Haircut & Styling',
                'description' => 'Professional haircut with modern styling',
                'price' => 35.00,
                'image' => 'haircut.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Hair Coloring',
                'description' => 'Full hair coloring with quality products',
                'price' => 80.00,
                'image' => 'coloring.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Manicure',
                'description' => 'Basic manicure with polish application',
                'price' => 25.00,
                'image' => 'manicure.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Pedicure',
                'description' => 'Foot care and relaxing pedicure',
                'price' => 30.00,
                'image' => 'pedicure.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Facial Treatment',
                'description' => 'Complete facial cleansing and treatment',
                'price' => 60.00,
                'image' => 'facial.jpg',
                'is_active' => true
            ],
        ];
        
        foreach ($services as $service) {
            Service::create($service);
        }
        
        $this->command->info('✅ 5 services seeded successfully!');
    }
}