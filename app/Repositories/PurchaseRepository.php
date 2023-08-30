<?php

    namespace App\Repositories;

    use Domain\Modules\Purchase\Entities\Purchase;
    use Domain\Modules\Purchase\Entities\PurchaseMedicine;
    use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Facades\DB;
    use App\Models\Purchase as PurchaseDB;

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
    }
