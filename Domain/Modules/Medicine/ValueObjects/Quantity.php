<?php

	namespace Domain\Modules\Medicine\ValueObjects;

	class Quantity
	{
        protected int $qty;

        public function __construct(int $qty)
        {
            $this->qty = $qty;
        }


        public function getInitialQty() : int {
            return $this->qty;
        }


    }
