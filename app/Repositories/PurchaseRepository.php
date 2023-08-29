<?php

	namespace App\Repositories;

	use Domain\Modules\Purchase\Entities\Purchase;
    use Domain\Modules\Purchase\Repositories\IPurchaseRepository;

    class PurchaseRepository extends Repository implements IPurchaseRepository
	{

        public function Save(Purchase $purchase): void
        {
            // TODO: Implement Save() method.
        }

        public function Update(Purchase $purchase): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit): array
        {
            // TODO: Implement GetAllPaginate() method.
        }
    }
