<?php

    namespace Database\Seeders;

    use App\Models\Customer;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class CustomerSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            Customer::factory()->create([
                'id'         => uuid(),
                'firstname'  => fake()->firstName,
                'lastname'   => fake()->lastName,
                'birthdate'  => fake()->date,
                'address'    => fake()->streetAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Customer::factory()->create([
                'id'         => uuid(),
                'firstname'  => fake()->firstName,
                'lastname'   => fake()->lastName,
                'birthdate'  => fake()->date,
                'address'    => fake()->streetAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Customer::factory()->create([
                'id'         => uuid(),
                'firstname'  => fake()->firstName,
                'lastname'   => fake()->lastName,
                'birthdate'  => fake()->date,
                'address'    => fake()->streetAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Customer::factory()->create([
                'id'         => uuid(),
                'firstname'  => fake()->firstName,
                'lastname'   => fake()->lastName,
                'birthdate'  => fake()->date,
                'address'    => fake()->streetAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Customer::factory()->create([
                'id'         => uuid(),
                'firstname'  => fake()->firstName,
                'lastname'   => fake()->lastName,
                'birthdate'  => fake()->date,
                'address'    => fake()->streetAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Customer::factory()->create([
                'id'         => uuid(),
                'firstname'  => fake()->firstName,
                'lastname'   => fake()->lastName,
                'birthdate'  => fake()->date,
                'address'    => fake()->streetAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Customer::factory()->create([
                'id'         => uuid(),
                'firstname'  => fake()->firstName,
                'lastname'   => fake()->lastName,
                'birthdate'  => fake()->date,
                'address'    => fake()->streetAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
