<?php

    namespace App\Repositories;

    use Domain\Modules\Purchase\Entities\Purchase;
    use Domain\Modules\Purchase\Entities\PurchaseMedicine;
    use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Facades\DB;
    use App\Models\Purchase as PurchaseDB;
    use App\Models\PurchaseMedicine as PurchaseMedicineDB;
    use Illuminate\Support\Collection;

    class PurchaseRepository extends Repository implements IPurchaseRepository
    {

        public function Save(Purchase $purchase, string $customer_id): void
        {
            DB::table('purchases')->insert([
                'id'             => $purchase->getId(),
                'customer_id'    => $customer_id,
                'date'           => $purchase->getDate(),
                'receipt_number' => $purchase->getReceiptNumber(),
                'total_amount'   => $purchase->getTotalAmount(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);


        }

        public function SavePurchaseMedicine(PurchaseMedicine $purchaseMedicine, string $purchase_id, string $medicine_id)
        {
            DB::table('purchase_medicines')->insert([
                'id'          => uuid(),
                'purchase_id' => $purchase_id,
                'medicine_id' => $medicine_id,
                'price'       => $purchaseMedicine->getPrice(),
                'qty'         => $purchaseMedicine->getQty(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        public function Update(Purchase $purchase): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $id): void
        {
            DB::table('purchases')->where(['id' => $id])->delete();
        }

        public function GetAllPaginate(int $page, int $limit): Paginator
        {
            return PurchaseDB::with(['PurchaseMedicine'])->paginate($limit);
        }

        public function GetAllPurchaseMedicineByPaginate(int $page, int $limit): Paginator
        {
            return PurchaseMedicineDB::with(['Medicine.Category'])->paginate($limit);
        }

        public function FindAllPurchaseMedicineByPaginate(int $page, int $limit, string $purchase_id): Paginator
        {
            return PurchaseMedicineDB::with(['Medicine.Category'])->where(['purchase_id' => $purchase_id])->paginate($limit);
        }

        public function Find(string $id): object
        {
            return PurchaseDB::with(['PurchaseMedicine.Medicine'])->where(['id' => $id])->first();
        }

        public function GetAll(): Collection
        {
            return PurchaseMedicineDB::with(['Purchase', 'Medicine'])->get();
        }

        public function GetAllMonthlySales(int $year): array
        {
            $sql = "SELECT MONTH(p.date) as month, p.total_amount as total ";
            $sql .= "FROM purchases p ";
            $sql .= "WHERE YEAR(p.date) = '".$year."'" ;
            return $this->query($sql);
        }
		
		public function  GetallCustomerPurchasesPaginate(string $customer_id, int $currentPage): Paginator
		{
			return PurchaseDB::where([ 'customer_id' => $customer_id])->paginate(5);
		}
    }
