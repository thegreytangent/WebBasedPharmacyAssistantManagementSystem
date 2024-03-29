<?php

    namespace Domain\Modules\Purchase\Repositories;

    use Domain\Modules\Purchase\Entities\Purchase;
    use Domain\Modules\Purchase\Entities\PurchaseMedicine;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Collection;

    interface IPurchaseRepository
    {

        public function Save(Purchase $purchase, string $customer_id): void;

        public function SavePurchaseMedicine(PurchaseMedicine $purchaseMedicine, string $purchase_id, string $medicine_id);

        public function Update(Purchase $purchase): void;

        public function Delete(string $id): void;

        public function GetAllPaginate(int $page, int $limit): Paginator;

        public function GetAllPurchaseMedicineByPaginate(int $page, int $limit): Paginator;

        public function FindAllPurchaseMedicineByPaginate(int $page, int $limit, string $purchase_id) : Paginator;

        public function Find(string $id) : object;

        public function GetAll() : Collection;

        public function GetAllMonthlySales(int $year) : array;
		
		public function GetallCustomerPurchasesPaginate(
			string $customer_id, int $currentPage
		) : Paginator;
		
		public function deleteAll(): void;
		
		public function GetWithMonthYear(string $month, string $year) : Collection;
	   
    }
