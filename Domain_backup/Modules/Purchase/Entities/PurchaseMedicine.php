<?php

	namespace Domain\Modules\Purchase\Entities;

	class PurchaseMedicine
	{
        protected int $qty;
        protected float $price;

        public function __construct(int $qty, float $price)
        {
            $this->qty   = $qty;
            $this->price = $price;
        }

        /**
         * @return int
         */
        public function getQty(): int
        {
            return $this->qty;
        }

        /**
         * @return float
         */
        public function getPrice(): float
        {
            return $this->price;
        }

        public function total() : int {

            return $this->getQty() * $this->getPrice();
        }




    }
