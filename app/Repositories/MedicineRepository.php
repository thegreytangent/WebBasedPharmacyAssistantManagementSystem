<?php

    namespace App\Repositories;

    use App\Models\Medicine as MedicineDB;
    use Domain\Modules\Medicine\Entities\Medicine;
    use Domain\Modules\Medicine\Repositories\IMedicineRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;
    
    class MedicineRepository extends Repository implements IMedicineRepository
    {

        public function Save(Medicine $medicine, string $category_id, string $supplier_id): void
        {
            DB::table('medicines')->insert([
                'id'            => $medicine->getId(),
                'category_id'   => $category_id,
                'supplier_id'   => $supplier_id,
                'medicine_name' => $medicine->getName(),
                'price'         => $medicine->price()->getPrice(),
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
            DB::table('medicines')->where('id', $medicine->getId())->update([
                'category_id'   => $category_id,
                'supplier_id'   => $supplier_id,
                'medicine_name' => $medicine->getName(),
                'price'         => $medicine->price()->getPrice(),
                'updated_at'    => now(),
            ]);

        }

        public function Delete(string $medicine_id): void
        {
            MedicineDB::destroy($medicine_id);
        }

        public function GetAllPaginate(int $page, int $limit): Paginator
        {

            return MedicineDB::with(['Category', 'Supplier'])->paginate(3);

        }
	    
	    
	    public function Find(string $id): Builder|Model
        {
            return MedicineDB::with(['Category', 'Supplier'])->where([
                'id' => $id
            ])->first();
        }

        public function CountBalance($id): int
        {
            return DB::table('inventories')->where([
                'medicine_id' => $id
            ])->count();
        }

        public function All(): array
        {
            $sql = "SELECT m.*, c.category_name as category_name FROM medicines m ";
            $sql .= "LEFT JOIN categories c on m.category_id = c.id" ;
            return $this->query($sql);
        }

        public function GetInventoryBalance(): Paginator
        {
            return MedicineDB::with(['PurchaseMedicines','Orders'])->paginate(3);
        }
	    
	    public function GetAllBySupplierPaginate(string $supplier_id, int $limit): Paginator
	    {
		    return MedicineDB::with(['Category', 'Supplier'])->where([
			    'supplier_id' => $supplier_id
		    ])->paginate(3);
	    }
		
		
		public function GetAllMedicineOrder(string $medicine_id, int $limit) : Paginator
		{
		
		}
    }
