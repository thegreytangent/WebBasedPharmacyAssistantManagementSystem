<?php

	namespace Domain\Modules\Customer\Repositories;

	use Domain\Modules\Customer\Entities\Customer;

    interface ICustomerRepository
	{
        public function Save(Customer $customer): void;

        public function Update(Customer $customer) : void;

        public function Delete(string $id) : void;


	}
