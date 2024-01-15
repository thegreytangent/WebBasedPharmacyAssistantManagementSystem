<?php

	namespace Domain\Modules\Medicine\Repositories;

	use Domain\Modules\Medicine\Entities\Medicine;
	use Illuminate\Contracts\Pagination\Paginator;
	use Illuminate\Database\Eloquent\Builder;
	use Illuminate\Database\Eloquent\Model;
	
	interface IMedicineRepository
	{
        public function Save(Medicine $medicine, string $category_id, string $supplier_id) : void;

        public function Update(Medicine $medicine, string $category_id, string $supplier_id) : void;

        public function Delete(string $medicine_id) : void;

        public function GetAllPaginate(int $page, int $limit) : Paginator ;

        public function All():array;

        public function Find(string $id) : Builder|Model;

        public function CountBalance($id) : int;

        public function GetInventoryBalance() : Paginator;
	    
	    public function GetAllBySupplierPaginate(string $supplier_id, int $limit): Paginator;
		
		public function GetAllMedicineOrder(string $medicine_id, int $limit): Paginator;
		
		public function GetAllBalance() : array;
	}
