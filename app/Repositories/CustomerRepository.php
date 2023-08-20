<?php

    namespace App\Repositories;

    use Domain\Modules\Customer\Entities\Customer;
    use Domain\Modules\Customer\Repositories\ICustomerRepository;
    use Illuminate\Support\Facades\DB;

    class CustomerRepository implements ICustomerRepository
    {

        public function Save(Customer $customer): void
        {
            DB::table('customers')->insert([
                'id'         => $customer->getId(),
                'firstname'  => $customer->getFirstname(),
                'lastname'   => $customer->getLastname(),
                'birthdate'  => $customer->getBirthdate()->getValue(),
                'address'    => $customer->getAddress(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        public function Update(Customer $customer): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $id): void
        {
            // TODO: Implement Delete() method.
        }
    }
