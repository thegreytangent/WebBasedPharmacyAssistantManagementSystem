<?php

    namespace Database\Seeders;

    // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            User::factory()->create([
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role'     => 'admin'
            ]);
            $this->call(CustomerSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(SupplierSeeder::class);
            $this->call(MedicineSeeder::class);
        }
    }
