<?php

	namespace Domain\Modules\Supplier\Repositories;

	use Domain\Modules\Supplier\Entities\Supplier;

    interface ISupplierRepository
	{
        public function Save(Supplier $supplier) : void;

        public function Update(Supplier $supplier) : void;

        public function Delete(string $supplier_id) : void;

        public function GetAllPaginate(int $page, int $limit) : array;
	}
