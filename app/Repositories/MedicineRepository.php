<?php

    namespace App\Repositories;

    use Domain\Modules\Medicine\Entities\Medicine;
    use Domain\Modules\Medicine\Repositories\IMedicineRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Facades\DB;
    use  \App\Models\Medicine as MedicineDB;

    class MedicineRepository extends Repository implements IMedicineRepository
    {

        public function Save(Medicine $medicine, string $category_id, string $supplier_id): void
        {
            DB::table('medicines')->insert([
                'id'            => $medicine->getId(),
                'category_id'   => $category_id,
                'supplier_id'   => $supplier_id,
                'medicine_name' => $medicine->getName(),
                'price'         => $medicine->getPrice(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            DB::table('inventories')->insert([
                'id'          => uuid(),
                'medicine_id' => $medicine->getId(),
                'date'        => now(),
                'qty'         => $medicine->getQuantity()
            ]);
        }

        public function Update(Medicine $medicine, string $category_id, string $supplier_id): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $medicine_id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit) : Paginator
        {

            return MedicineDB::with(['Category', 'Supplier' ])->paginate(3);

        }

        public function Find(string $id): Medicine|null
        {
            return null;
        }
    }
