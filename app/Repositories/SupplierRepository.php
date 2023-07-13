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
            SupplierDB::find($supplier->getId())->update([
                'name'           => $supplier->getName(),
                'contact_number' => $supplier->getContactNumber()->getOriginalInput(),
            ]);
        }

        public function Delete(string $supplier_id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit)
        {
            return SupplierDB::paginate($limit);
        }

        public function Find(string $id): Supplier|null
        {
            $d = DB::table('suppliers')->find($id);
            return !$d ? null : new Supplier($d->name, new ContactNumber($d->contact_number), $d->id);
        }
    }
