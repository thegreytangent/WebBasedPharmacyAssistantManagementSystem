<?php

    namespace Database\Factories;

    use App\Models\Category;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends Factory<Category>
     */
    class CategoryFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'id'            => uuid(),
                'category_name' => $this->faker->name,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }
    }
