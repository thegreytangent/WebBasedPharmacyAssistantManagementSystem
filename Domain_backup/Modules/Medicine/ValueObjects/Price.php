<?php

	namespace Domain\Modules\Medicine\ValueObjects;

	class Price
	{
        protected float $price;

        public function __construct(float $price)
        {
            $this->price = $price;

        }

        /**
         * @return float
         */
        public function getPrice(): float
        {
            return $this->price;
        }

        public function displayPrice() : string {
            return number_format($this->price,2);
        }




    }

