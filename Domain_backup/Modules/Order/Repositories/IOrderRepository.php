<?php

	namespace Domain\Modules\Order\Repositories;

	use Domain\Modules\Order\Entities\Order;
    use Illuminate\Contracts\Pagination\Paginator;

    interface IOrderRepository
	{
        public function Save(Order $order, string $supplier_id, string $medicine_id) : void;

        public function Update(Order $order) : void;

        public function Delete(string $order_id) : void;

        public function GetAllPaginate(int $page, int $limit) : Paginator ;
	    
	    public function GetAllMedicinePaginate(string $medicine_id, int $page, int $limit) : Paginator ;

        public function Find(string $id) : Order | null;

        public function All(): array;

        public function CountAllTotalOrders() : int;
	}
