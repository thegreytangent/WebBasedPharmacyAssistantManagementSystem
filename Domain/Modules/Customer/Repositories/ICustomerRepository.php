<?php

	namespace Domain\Modules\Customer\Repositories;

	use App\Models\Customer as CustomerDB;
	use Domain\Modules\Customer\Entities\Customer;
    use Illuminate\Contracts\Pagination\Paginator;
	use Illuminate\Database\Eloquent\Collection;
	
	interface ICustomerRepository
	{
        public function Save(Customer $customer): void;

        public function Update(Customer $customer) : void;

        public function Delete(string $id) : void;

        public function GetAllPaginate(int $page, int $count) : Paginator;

        public function Find(string $id) : Customer | null;

        public function All() : array;
	
		
		public function FindByUser(string $user_id) : CustomerDB;


	}
