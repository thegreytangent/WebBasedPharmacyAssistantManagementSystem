<?php

    namespace Database\Seeders;

    use App\Models\Supplier;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class SupplierSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            Supplier::create([
                'name'    => fake()->company,
                'contact_number' => fake()->numberBetween(1111111,99999999)
            ]);
            Supplier::create([
                'name'    => fake()->company,
                'contact_number' => fake()->numberBetween(1111111,99999999)
            ]);
            Supplier::create([
                'name'    => fake()->company,
                'contact_number' => fake()->numberBetween(1111111,99999999)
            ]);
        }
    }
