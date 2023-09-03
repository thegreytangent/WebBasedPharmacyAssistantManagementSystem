<?php

    namespace Domain\Modules\Purchase\Repositories;

    use Domain\Modules\Purchase\Entities\Purchase;
    use Domain\Modules\Purchase\Entities\PurchaseMedicine;
    use Illuminate\Contracts\Pagination\Paginator;

    interface IPurchaseRepository
    {

        public function Save(Purchase $purchase, string $customer_id): void;

        public function SavePurchaseMedicine(PurchaseMedicine $purchaseMedicine, string $purchase_id, string $medicine_id);

        public function Update(Purchase $purchase): void;

        public function Delete(string $id): void;

        public function GetAllPaginate(int $page, int $limit): Paginator;

        public function GetAllPurchaseMedicineByPaginate(int $page, int $limit): Paginator;

    }
