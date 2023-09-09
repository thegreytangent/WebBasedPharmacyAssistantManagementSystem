<?php

	namespace Domain\Modules\Supplier\Repositories;

	use Domain\Modules\Supplier\Entities\Supplier;
    use Illuminate\Pagination\Paginator;

    interface ISupplierRepository
	{
        public function Save(Supplier $supplier) : void;

        public function Update(Supplier $supplier) : void;

        public function Delete(string $supplier_id) : void;

        public function GetAllPaginate(int $page, int $limit) ;

        public function Find(string $id) : Supplier | null;

        public function All(): array;

        public function CountNumberOfSuppliers() : int;
	}
