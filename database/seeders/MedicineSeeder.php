<?php

    namespace Database\Seeders;

    use App\Models\Category;
    use App\Models\Medicine;
    use App\Models\Supplier;
    use Illuminate\Database\Seeder;

    class MedicineSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            Medicine::create([
                'category_id'   => Category::first()->id,
                'supplier_id'   => Supplier::first()->id,
                'price' => fake()->numberBetween(1,3),
                'medicine_name' => fake()->colorName,
            ]);

            Medicine::create([
                'category_id'   => Category::first()->id,
                'supplier_id'   => Supplier::first()->id,
                'price' => fake()->numberBetween(1,3),
                'medicine_name' => fake()->colorName,
            ]);

        }
    }
