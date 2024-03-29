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
				'type'          => $medicine->getType(),
				'uom'           => $medicine->getUnitOfMeasurement(),
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
			
			return MedicineDB::with(['Category', 'Supplier'])->paginate(10);
			
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
			$sql .= "LEFT JOIN categories c on m.category_id = c.id";
			return $this->query($sql);
		}
		
		public function GetInventoryBalance(): Paginator
		{
			return MedicineDB::with(['PurchaseMedicines', 'Orders'])->paginate(10);
		}
		
		public function GetAllBySupplierPaginate(string $supplier_id, int $limit): Paginator
		{
			return MedicineDB::with(['Category', 'Supplier'])->where([
				'supplier_id' => $supplier_id
			])->paginate(10);
		}
		
		public function GetAllBalance(): array
		{
			$sql = "SELECT SUM(o.qty) - (CASE WHEN  SUM(pm.qty) IS NULL THEN 0 ELSE SUM(pm.qty) END) as balance, o.medicine_id as id FROM orders o ";
			$sql .= "LEFT JOIN purchase_medicines pm on o.medicine_id = pm.medicine_id ";
			$sql .= "GROUP BY o.medicine_id";
			return $this->query($sql);
		}
		
		public function getAllOrderWithQtyGroupByMedicine()
		{
			$sql = "SELECT SUM(qty) as qty, medicine_id FROM orders GROUP BY medicine_id";
			return $this->query($sql);
		}
		
		public function findByMedicineTotalPurchases($med_id)
		{
			$sql = "SELECT (CASE WHEN  SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END) as qty, medicine_id FROM purchase_medicines WHERE medicine_id = '" . $med_id . "'";
			$result = $this->query($sql);
			return $result ? array_shift($result) : null;
			
		}
		
		public function GetAllMedicineOrder(string $medicine_id, int $limit): Paginator
		{
			// TODO: Implement GetAllMedicineOrder() method.
		}
	}
