<?php

    namespace App\Repositories;

    use Domain\Modules\Medicine\Entities\Medicine;
    use Domain\Modules\Medicine\Repositories\IMedicineRepository;

    class MedicineRepository implements IMedicineRepository
    {

        public function Save(Medicine $medicine, string $category_id, string $supplier_id): void
        {
            // TODO: Implement Save() method.
        }

        public function Update(Medicine $medicine, string $category_id, string $supplier_id): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $medicine_id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit)
        {
            // TODO: Implement GetAllPaginate() method.
        }

        public function Find(string $id): Medicine|null
        {
            // TODO: Implement Find() method.
        }
    }
