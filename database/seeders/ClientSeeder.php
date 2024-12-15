<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $currentYear = date('Y');

        foreach (range(1, 1000) as $index) {
            // Ensure the name is unique
            do {
                $name = $faker->unique()->name;
            } while (DB::table('clients')->where('name', $name)->exists());

            DB::table('clients')->insert([
                'name' => $name,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => now(),
            ]);
        }
    }
}
