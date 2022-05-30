<?php

namespace Database\Seeders;

use App\Models\Document;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();

        Document::create([
            'id' => $faker->uuid,
            'status' => 'draft',
        ]);
    }
}
