<?php
	
	namespace Database\Seeders;
	
	use App\Models\Customer;
	use App\Models\User;
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	
	class CustomerSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			
			foreach (User::all() as $user) {
				if ($user->role == 'customer') {
					Customer::factory()->create([
						'id'         => uuid(),
						'user_id'    => $user->id,
						'firstname'  => fake()->firstName,
						'lastname'   => fake()->lastName,
						'birthdate'  => fake()->date,
						'address'    => fake()->streetAddress,
						'created_at' => now(),
						'updated_at' => now(),
					]);
				}
				
			}
			
			
		}
	}
