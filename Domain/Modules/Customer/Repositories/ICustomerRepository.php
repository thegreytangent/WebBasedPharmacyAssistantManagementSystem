<?php

	namespace Domain\Modules\Customer\Repositories;

	use Domain\Modules\Customer\Entities\Customer;
    use Illuminate\Contracts\Pagination\Paginator;

    interface ICustomerRepository
	{
        public function Save(Customer $customer): void;

        public function Update(Customer $customer) : void;

        public function Delete(string $id) : void;

        public function GetAllPaginate(int $page, int $count) : Paginator;

        public function Find(string $id) : Customer | null;

        public function All() : array;



	}
