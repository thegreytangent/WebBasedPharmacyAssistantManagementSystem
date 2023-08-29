<?php

    namespace App\Repositories;

    use Domain\Modules\Customer\Entities\Customer;
    use Domain\Modules\Customer\Repositories\ICustomerRepository;
    use Domain\Shared\ValueObjects\Birthdate;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Facades\DB;
    use App\Models\Customer as CustomerDB;


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
            DB::table('customers')->where('id', $customer->getId())->update([
                'firstname'  => $customer->getFirstname(),
                'lastname'   => $customer->getLastname(),
                'birthdate'  => $customer->getBirthdate()->getValue(),
                'address'    => $customer->getAddress(),
                'updated_at' => now(),
            ]);
        }

        public function Delete(string $id): void
        {
           DB::table('customers')->delete($id);
        }

        public function GetAllPaginate(int $page, int $count): Paginator
        {
            return CustomerDB::paginate($count);
        }

        public function Find(string $id): Customer|null
        {
          $c = DB::table('customers')->where(['id' => $id])->first();
          if (!$c) return null;
          $customer = new Customer($c->firstname,$c->lastname,new Birthdate($c->birthdate), $id);
          $customer->setAddress($c->address);
          return $customer;

        }

        public function All(): array
        {
           return DB::table('customers')->get()->toArray();
        }
    }
