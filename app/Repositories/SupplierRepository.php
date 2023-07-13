<?php

    namespace App\Repositories;

    use Domain\Modules\Supplier\Entities\Supplier;
    use Domain\Modules\Supplier\Repositories\ISupplierRepository;
    use App\Models\Supplier as SupplierDB;
    use Domain\Shared\ValueObjects\ContactNumber;
    use Illuminate\Pagination\Paginator;
    use Illuminate\Support\Facades\DB;

    class SupplierRepository implements ISupplierRepository
    {


        public function Save(Supplier $supplier): void
        {
            SupplierDB::create([
                'name'           => $supplier->getName(),
                'contact_number' => $supplier->getContactNumber()->getOriginalInput(),
            ]);
        }

        public function Update(Supplier $supplier): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $supplier_id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit)
        {
            return SupplierDB::paginate($limit);
        }
    }
