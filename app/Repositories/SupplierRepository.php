<?php

	namespace App\Repositories;

	use Domain\Modules\Supplier\Entities\Supplier;
    use Domain\Modules\Supplier\Repositories\ISupplierRepository;

    class SupplierRepository implements ISupplierRepository
    {


        public function Save(Supplier $supplier): void
        {
            // TODO: Implement Save() method.
        }

        public function Update(Supplier $supplier): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $supplier_id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit): array
        {
            // TODO: Implement GetAllPaginate() method.
        }
    }
