<?php

	namespace Domain\Modules\Medicine\Repositories;

	use Domain\Modules\Medicine\Entities\Medicine;
    use Illuminate\Contracts\Pagination\Paginator;

    interface IMedicineRepository
	{
        public function Save(Medicine $medicine, string $category_id, string $supplier_id) : void;

        public function Update(Medicine $medicine, string $category_id, string $supplier_id) : void;

        public function Delete(string $medicine_id) : void;

        public function GetAllPaginate(int $page, int $limit) : Paginator ;

        public function Find(string $id) : Medicine | null;
	}
