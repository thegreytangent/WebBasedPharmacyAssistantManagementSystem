<?php

    namespace Domain\Modules\Order\Entities;

    use Domain\Shared\Entity;
    use Illuminate\Support\Carbon;

    class Order extends Entity
    {

        protected string $order_number;
        protected string $date;
        protected int $qty;


        public function __construct($order_number, $date, $qty, ?string $id = null)
        {
            $this->order_number = $order_number;
            $this->date         = $date;
            $this->qty          = $qty;

            parent::__construct($id);
        }

        public static function generateOrderNumber(): string
        {
            return 'DR-' . mt_rand();
        }

        /**
         * @return string
         */
        public function getOrderNumber(): string
        {
            return $this->order_number;
        }

        /**
         * @return string
         */
        public function getDate(): string
        {
            return $this->date;
        }

        public function longDate() : string {
            return Carbon::parse($this->date)->format('F j, Y');
        }

        /**
         * @return int
         */
        public function getQty(): int
        {
            return $this->qty;
        }


    }
