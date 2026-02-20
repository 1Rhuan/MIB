<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'slug' => Str::slug('VIP Mensal'),
                'title' => 'VIP Mensal',
                'description' => 'Plano válido por 1 mês',
                'benefits' => json_encode([
                    'Sem filas',
                    'Acesso a slots exclusivos',
                    'Preferência na entrada do servidor',
                ]),
                'price' => 15.0,
                'discount' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('VIP Trimestral'),
                'title' => 'VIP Trimestral',
                'description' => 'Plano válido por 3 meses',
                'benefits' => json_encode([
                    'Sem filas',
                    'Acesso a slots exclusivos',
                    'Preferência na entrada do servidor',
                ]),
                'price' => 45.0,
                'discount' => 5.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => Str::slug('VIP Anual'),
                'title' => 'VIP Anual',
                'description' => 'Plano válido por 12 meses',
                'benefits' => json_encode([
                    'Sem filas',
                    'Acesso a slots exclusivos',
                    'Preferência na entrada do servidor',
                    'Tag patrocinador no Discord',
                ]),
                'price' => 180.0,
                'discount' => 15.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
