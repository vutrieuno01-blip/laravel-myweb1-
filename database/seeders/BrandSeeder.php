<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $name = fake()->unique()->word();

            DB::table('brands')
                ->insert([
                    'brandname' => $name,
                    'slug' => Str::slug($name),
                    'image' => 'brand.jpg',
                    'status' => 1,
                    'description' => fake()->sentence(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
    }
}
