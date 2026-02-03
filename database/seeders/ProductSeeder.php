<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'VIP Quinzenal',
                'reference' => Str::ulid(),
                'description' => 'Sem filas no servidor por 15 dias',
                'price' => 9.9,
                'active' => false,
                'category' => 'services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'VIP Mensal',
                'reference' => Str::ulid(),
                'description' => 'Sem filas no servidor por 1 mês',
                'price' => 15.0,
                'active' => true,
                'category' => 'services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'VIP Trimestral',
                'reference' => Str::ulid(),
                'description' => 'Sem filas no servidor da por 3 mêses',
                'price' => 40.0,
                'active' => true,
                'category' => 'services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'VIP Semestral',
                'reference' => Str::ulid(),
                'description' => 'Sem filas no servidor da por 6 mêses',
                'price' => 79.0,
                'active' => true,
                'category' => 'services',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
