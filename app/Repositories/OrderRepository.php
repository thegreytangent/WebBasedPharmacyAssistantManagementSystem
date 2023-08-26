<?php

    namespace App\Repositories;

    use Domain\Modules\Order\Entities\Order;
    use Domain\Modules\Order\Repositories\IOrderRepository;
    use Illuminate\Support\Facades\DB;

    class OrderRepository implements IOrderRepository
    {

        public function Save(Order $order, string $supplier_id, string $medicine_id): void
        {
            DB::table('orders')->insert([
                'id'           => $order->getId(),
                'order_number' => $order->getOrderNumber(),
                'date'         => $order->getDate(),
                'supplier_id'  => $supplier_id,
                'medicine_id'  => $medicine_id,
                'qty'          => $order->getQty(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        public function Update(Order $order): void
        {
            // TODO: Implement Update() method.
        }

        public function Delete(string $order_id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit)
        {
            // TODO: Implement GetAllPaginate() method.
        }

        public function Find(string $id): Order|null
        {
            // TODO: Implement Find() method.
        }

        public function All(): array
        {
            // TODO: Implement All() method.
        }
    }
